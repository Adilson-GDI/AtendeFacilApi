<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PushToken;
use Illuminate\Http\Request;

class PushTokenController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'push_token'   => ['required', 'string', 'max:500'],
            'empresa_id'   => ['nullable', 'integer'],
            'device_name'  => ['nullable', 'string', 'max:150'],
            'platform'     => ['nullable', 'string', 'max:20'],
            'permission'   => ['nullable', 'string', 'max:30'],
            'tipo_servico' => ['nullable', 'string', 'max:100'],
            'app_version'  => ['nullable', 'string', 'max:30'],
        ]);

        $user = $request->user();

        $token = PushToken::updateOrCreate(
            [
                'push_token' => $request->push_token,
            ],
            [
                'empresa_id'   => $request->empresa_id,
                'user_id'      => $user?->id ?? 0,
                'device_name'  => $request->device_name,
                'platform'     => $request->platform,
                'permission'   => $request->permission,
                'tipo_servico' => $request->tipo_servico ?? 'GERAL',
                'app_version'  => $request->app_version,
                'ativo'        => true,
                'updated_at'   => now(),
            ]
        );

        return response()->json([
            'status' => true,
            'message' => 'Token push salvo com sucesso.',
            'data' => $token,
        ]);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'push_token' => ['required', 'string', 'max:500'],
        ]);

        PushToken::where('push_token', $request->push_token)
            ->update([
                'ativo' => false,
                'updated_at' => now(),
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Token push desativado com sucesso.',
        ]);
    }
}