<?php

namespace App\Services;

use Exception;
use Google\Client;
use Illuminate\Support\Facades\Http;

class FirebasePushService
{
    protected string $projectId;
    protected string $serviceAccountPath;

    public function __construct()
    {
        $this->projectId = config('services.firebase.project_id');
        $this->serviceAccountPath = storage_path('app/firebase/firebase-key.json');
    }

    public function sendToToken(
        string $token,
        string $title,
        string $body,
        ?string $imageUrl = null,
        array $data = []
    ): array {
        return $this->sendMessage([
            'token' => $token,
            'notification' => $this->makeNotification($title, $body, $imageUrl),
            'data' => $this->normalizeData($data),
        ]);
    }

    public function sendToTopic(
        string $topic,
        string $title,
        string $body,
        ?string $imageUrl = null,
        array $data = []
    ): array {
        $topic = str_replace('/topics/', '', $topic);

        return $this->sendMessage([
            'topic' => $topic,
            'notification' => $this->makeNotification($title, $body, $imageUrl),
            'data' => $this->normalizeData($data),
        ]);
    }

    public function sendToManyTokens(
        array $tokens,
        string $title,
        string $body,
        ?string $imageUrl = null,
        array $data = []
    ): array {
        $results = [
            'success' => 0,
            'error' => 0,
            'responses' => [],
        ];

        foreach ($tokens as $token) {
            try {
                $response = $this->sendToToken(
                    $token,
                    $title,
                    $body,
                    $imageUrl,
                    $data
                );

                $results['success']++;
                $results['responses'][] = $response;
            } catch (Exception $e) {
                $results['error']++;
                $results['responses'][] = [
                    'token' => $token,
                    'error' => $e->getMessage(),
                ];
            }
        }

        return $results;
    }

    protected function sendMessage(array $message): array
    {
        $accessToken = $this->getAccessToken();

        $url = "https://fcm.googleapis.com/v1/projects/{$this->projectId}/messages:send";

        $response = Http::withToken($accessToken)
            ->acceptJson()
            ->post($url, [
                'message' => $message,
            ]);

        if ($response->failed()) {
            throw new Exception($response->body());
        }

        return $response->json();
    }

    protected function getAccessToken(): string
    {
        if (!$this->projectId) {
            throw new Exception('FIREBASE_PROJECT_ID não configurado.');
        }

        if (!file_exists($this->serviceAccountPath)) {
            throw new Exception('Arquivo firebase-key.json não encontrado em storage/app/firebase/.');
        }

        $client = new Client();
        $client->setAuthConfig($this->serviceAccountPath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');

        $token = $client->fetchAccessTokenWithAssertion();

        if (!isset($token['access_token'])) {
            throw new Exception('Não foi possível gerar access token do Firebase.');
        }

        return $token['access_token'];
    }

    protected function makeNotification(string $title, string $body, ?string $imageUrl = null): array
    {
        $notification = [
            'title' => $title,
            'body' => $body,
        ];

        if (!empty($imageUrl)) {
            $notification['image'] = $imageUrl;
        }

        return $notification;
    }

    protected function normalizeData(array $data): array
    {
        $normalized = [];

        foreach ($data as $key => $value) {
            if ($value === null) {
                continue;
            }

            $normalized[$key] = is_array($value)
                ? json_encode($value, JSON_UNESCAPED_UNICODE)
                : (string) $value;
        }

        return $normalized;
    }
}