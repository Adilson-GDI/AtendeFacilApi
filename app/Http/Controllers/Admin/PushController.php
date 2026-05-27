<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PushLog;
use App\Models\PushToken;
use App\Services\FirebasePushService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PushController extends Controller
{
    public function index()
    {
        $totalTokens = PushToken::where('ativo', true)->count();

        $tokensPorPlataforma = PushToken::where('ativo', true)
            ->selectRaw('platform, COUNT(*) as total')
            ->groupBy('platform')
            ->pluck('total', 'platform');

        $logs = PushLog::orderByDesc('id')
            ->limit(100)
            ->get();

        return view('admin.push.index', [
            'totalTokens' => $totalTokens,
            'tokensPorPlataforma' => $tokensPorPlataforma,
            'logs' => $logs,
        ]);
    }

    public function send(Request $request, FirebasePushService $firebase)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'image_url' => ['nullable', 'string', 'max:500'],
            'target_type' => ['required', 'in:all,token,topic'],
            'token_value' => ['nullable', 'string'],
            'topic_value' => ['nullable', 'string', 'max:100'],

            'action_type' => ['nullable', 'string', 'max:50'],
            'action_value' => ['nullable', 'string'],
        ]);

        $title = $request->title;
        $body = $request->body;
        $imageUrl = $request->image_url;
        $targetType = $request->target_type;

        $actionData = $this->buildActionData($request);

        $tokens = [];
        $targetValue = null;
        $result = [
            'success' => 0,
            'error' => 0,
            'responses' => [],
        ];

        try {
            if ($targetType === 'all') {
                $tokens = PushToken::where('ativo', true)
                    ->whereNotNull('push_token')
                    ->pluck('push_token')
                    ->toArray();

                $targetValue = 'ALL';

                $result = $firebase->sendToManyTokens(
                    $tokens,
                    $title,
                    $body,
                    $imageUrl,
                    $actionData
                );
            }

            if ($targetType === 'token') {
                $request->validate([
                    'token_value' => ['required', 'string'],
                ]);

                $targetValue = $request->token_value;
                $tokens = [$targetValue];

                $response = $firebase->sendToToken(
                    $targetValue,
                    $title,
                    $body,
                    $imageUrl,
                    $actionData
                );

                $result['success'] = 1;
                $result['responses'][] = $response;
            }

            if ($targetType === 'topic') {
                $request->validate([
                    'topic_value' => ['required', 'string', 'max:100'],
                ]);

                $targetValue = $request->topic_value;

                $response = $firebase->sendToTopic(
                    $targetValue,
                    $title,
                    $body,
                    $imageUrl,
                    $actionData
                );

                $result['success'] = 1;
                $result['responses'][] = $response;
            }

            PushLog::create([
                'empresa_id' => null,
                'user_id' => auth()->id() ?? 0,
                'title' => $title,
                'body' => $body,
                'image_url' => $imageUrl,
                'target_type' => $targetType,
                'target_value' => $targetValue,
                'action_type' => $actionData['action'] ?? null,
                'action_value' => $actionData['value'] ?? null,
                'action_data' => $actionData,
                'total_targets' => count($tokens),
                'total_success' => $result['success'] ?? 0,
                'total_error' => $result['error'] ?? 0,
                'response_data' => $result,
                'sent_at' => now(),
            ]);

            return redirect()
                ->route('admin.push.index')
                ->with('success', 'Push enviado com sucesso.');
        } catch (\Throwable $e) {
            Log::error('Erro ao enviar push', [
                'erro' => $e->getMessage(),
            ]);

            return redirect()
                ->route('admin.push.index')
                ->with('error', 'Erro ao enviar push: ' . $e->getMessage());
        }
    }

    public function resend(int $id, FirebasePushService $firebase)
    {
        $log = PushLog::findOrFail($id);

        $fakeRequest = new Request([
            'title' => $log->title,
            'body' => $log->body,
            'image_url' => $log->image_url,
            'target_type' => $log->target_type,
            'token_value' => $log->target_type === 'token' ? $log->target_value : null,
            'topic_value' => $log->target_type === 'topic' ? $log->target_value : null,
            'action_type' => $log->action_type,
            'action_value' => $log->action_value,
        ]);

        return $this->send($fakeRequest, $firebase);
    }

    private function buildActionData(Request $request): array
    {
        $actionType = $request->action_type;
        $actionValue = $request->action_value;

        if (!$actionType || !$actionValue) {
            return [];
        }

        return match ($actionType) {
            'open_page' => [
                'action' => 'open_page',
                'page' => $actionValue,
                'value' => $actionValue,
            ],
            'open_url' => [
                'action' => 'open_url',
                'url' => $actionValue,
                'value' => $actionValue,
            ],
            'open_whatsapp' => [
                'action' => 'open_whatsapp',
                'phone' => $actionValue,
                'value' => $actionValue,
            ],
            'open_project' => [
                'action' => 'open_project',
                'id' => $actionValue,
                'value' => $actionValue,
            ],
            default => [
                'action' => $actionType,
                'value' => $actionValue,
            ],
        };
    }
}