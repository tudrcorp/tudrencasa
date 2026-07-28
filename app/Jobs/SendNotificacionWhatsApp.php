<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Support\WhatsAppBrandImage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendNotificacionWhatsApp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 5;

    /**
     * @return array<int, int>
     */
    public function backoff(): array
    {
        return [10, 20, 60, 120, 300];
    }

    public function __construct(
        public string $body,
        public string $phone,
        public array $context = [],
        public ?string $imageUrl = null,
    ) {}

    public function handle(): void
    {
        $token = (string) config('whatsapp.token');

        if ($token === '') {
            Log::warning('WhatsApp omitido: falta WHATSAPP_TOKEN.', [
                'to' => $this->phone,
                'context' => $this->context,
            ]);

            return;
        }

        $imageUrl = $this->imageUrl ?? WhatsAppBrandImage::publicUrl();
        $useImage = filled($imageUrl) && filled(config('whatsapp.image_api_url'));

        $apiUrl = $useImage
            ? (string) config('whatsapp.image_api_url')
            : (string) config('whatsapp.chat_url');

        if ($apiUrl === '') {
            Log::warning('WhatsApp omitido: falta WHATSAPP_IMAGE_URL o WHATSAPP_CHAT_URL.', [
                'to' => $this->phone,
                'context' => $this->context,
            ]);

            return;
        }

        $curl = curl_init();
        $response = null;
        $httpCode = null;
        $error = null;

        try {
            $params = $useImage
                ? [
                    'token' => $token,
                    'image' => $imageUrl,
                    'to' => $this->phone,
                    'caption' => $this->body,
                ]
                : [
                    'token' => $token,
                    'to' => $this->phone,
                    'body' => $this->body,
                ];

            curl_setopt_array($curl, [
                CURLOPT_URL => $apiUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => http_build_query($params),
                CURLOPT_HTTPHEADER => [
                    'content-type: application/x-www-form-urlencoded',
                ],
            ]);

            $response = curl_exec($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $error = curl_error($curl);

            if ($error || $httpCode >= 400) {
                throw new \Exception("CURL Error ({$httpCode}): ".($error ?: (string) $response));
            }

            if (! $this->apiResponseSucceeded($response, (int) $httpCode)) {
                if ($useImage && $this->shouldFallbackToChat($response)) {
                    Log::warning('WhatsApp: imagen no disponible, enviando solo texto.', [
                        'to' => $this->phone,
                        'image' => $imageUrl,
                        'response' => is_string($response) ? mb_substr($response, 0, 500) : null,
                    ]);

                    $this->sendChatMessage($token, $this->body);

                    return;
                }

                throw new \Exception(
                    'UltraMsg rechazó el envío: '.$this->extractApiErrorMessage($response, (int) $httpCode)
                );
            }

            Log::info('WhatsApp enviado correctamente', [
                'to' => $this->phone,
                'status' => $httpCode,
                'type' => $useImage ? 'image' : 'chat',
                'image' => $useImage ? $imageUrl : null,
                'response' => is_string($response) ? mb_substr($response, 0, 500) : null,
                'context' => $this->context,
            ]);
        } catch (Throwable $e) {
            Log::error('Fallo en Job SendNotificacionWhatsApp', [
                'to' => $this->phone,
                'error' => $e->getMessage(),
                'status_code' => $httpCode,
                'curl_error' => $error,
                'response' => is_string($response) ? mb_substr($response, 0, 1200) : null,
                'context' => $this->context,
            ]);

            throw $e;
        } finally {
            curl_close($curl);
        }
    }

    public function failed(Throwable $exception): void
    {
        Log::critical('WhatsApp Job falló definitivamente tras varios reintentos', [
            'to' => $this->phone,
            'error' => $exception->getMessage(),
            'context' => $this->context,
        ]);
    }

    private function apiResponseSucceeded(mixed $response, int $httpCode): bool
    {
        if ($httpCode < 200 || $httpCode >= 300) {
            return false;
        }

        if (! is_string($response) || trim($response) === '') {
            return false;
        }

        $decoded = json_decode($response, true);

        if (! is_array($decoded)) {
            return false;
        }

        if (array_key_exists('error', $decoded) && filled($decoded['error'])) {
            return false;
        }

        return ($decoded['sent'] ?? null) === 'true'
            || ($decoded['sent'] ?? null) === true
            || isset($decoded['id'])
            || isset($decoded['message']);
    }

    private function shouldFallbackToChat(mixed $response): bool
    {
        if (! is_string($response)) {
            return false;
        }

        return str_contains($response, 'File not exist')
            || str_contains($response, 'image')
            || str_contains($response, 'download');
    }

    private function sendChatMessage(string $token, string $body): void
    {
        $chatUrl = (string) config('whatsapp.chat_url');

        if ($chatUrl === '') {
            throw new \Exception('No hay WHATSAPP_CHAT_URL configurada para el fallback de texto.');
        }

        $curl = curl_init();
        $response = null;
        $httpCode = null;
        $error = null;

        try {
            $params = [
                'token' => $token,
                'to' => $this->phone,
                'body' => $body,
            ];

            curl_setopt_array($curl, [
                CURLOPT_URL => $chatUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => http_build_query($params),
                CURLOPT_HTTPHEADER => ['content-type: application/x-www-form-urlencoded'],
            ]);

            $response = curl_exec($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $error = curl_error($curl);

            if ($error || $httpCode >= 400) {
                throw new \Exception("CURL Error ({$httpCode}): ".($error ?: (string) $response));
            }

            if (! $this->apiResponseSucceeded($response, (int) $httpCode)) {
                throw new \Exception(
                    'UltraMsg rechazó el envío de texto: '.$this->extractApiErrorMessage($response, (int) $httpCode)
                );
            }

            Log::info('WhatsApp enviado correctamente (solo texto)', [
                'to' => $this->phone,
                'status' => $httpCode,
                'context' => $this->context,
            ]);
        } finally {
            curl_close($curl);
        }
    }

    private function extractApiErrorMessage(mixed $response, int $httpCode): string
    {
        if (! is_string($response) || trim($response) === '') {
            return "HTTP {$httpCode} sin detalle";
        }

        $decoded = json_decode($response, true);

        if (is_array($decoded)) {
            $error = $decoded['error'] ?? $decoded['message'] ?? null;

            if (is_string($error) && filled($error)) {
                return mb_substr($error, 0, 1000);
            }
        }

        return mb_substr($response, 0, 1000);
    }
}
