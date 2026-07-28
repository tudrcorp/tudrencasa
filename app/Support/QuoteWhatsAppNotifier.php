<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

final class QuoteWhatsAppNotifier
{
    /**
     * @param  array{
     *     full_name: string,
     *     phone?: string|null,
     *     email?: string|null,
     *     state: string,
     *     city: string,
     *     observations?: string|null
     * }  $data
     */
    public static function notify(array $data): void
    {
        $phones = config('whatsapp.quote_phones', []);

        if ($phones === []) {
            return;
        }

        $body = self::buildBody($data);
        $imageUrl = WhatsAppBrandImage::publicUrl();

        foreach ($phones as $phone) {
            try {
                self::send(
                    $body,
                    (string) $phone,
                    ['source' => 'quote.store'],
                    $imageUrl,
                );
            } catch (Throwable $exception) {
                Log::error('QUOTE-REQUEST: fallo al enviar WhatsApp (se continúa con éxito al usuario).', [
                    'to' => $phone,
                    'error' => $exception->getMessage(),
                    'context' => ['source' => 'quote.store'],
                ]);
            }
        }
    }

    /**
     * @param  array{
     *     full_name: string,
     *     phone?: string|null,
     *     email?: string|null,
     *     state: string,
     *     city: string,
     *     observations?: string|null
     * }  $data
     */
    public static function buildBody(array $data): string
    {
        $fullName = (string) ($data['full_name'] ?? '—');
        $phone = filled($data['phone'] ?? null) ? (string) $data['phone'] : '—';
        $email = filled($data['email'] ?? null) ? (string) $data['email'] : '—';
        $state = (string) ($data['state'] ?? '—');
        $city = (string) ($data['city'] ?? '—');
        $observations = filled($data['observations'] ?? null) ? (string) $data['observations'] : '—';

        return <<<TEXT
*Nueva solicitud de cotización — TuDrenCasa*

*Nombre:* {$fullName}
*Teléfono:* {$phone}
*Correo:* {$email}
*Estado:* {$state}
*Ciudad:* {$city}
*Observaciones:* {$observations}
TEXT;
    }

    /**
     * @param  array<string, mixed>  $context
     */
    private static function send(string $body, string $phone, array $context = [], ?string $imageUrl = null): void
    {
        $token = (string) config('whatsapp.token');

        if ($token === '') {
            Log::warning('WhatsApp omitido: falta WHATSAPP_TOKEN.', [
                'to' => $phone,
                'context' => $context,
            ]);

            return;
        }

        $imageUrl = $imageUrl ?? WhatsAppBrandImage::publicUrl();
        $useImage = filled($imageUrl) && filled(config('whatsapp.image_api_url'));

        $apiUrl = $useImage
            ? (string) config('whatsapp.image_api_url')
            : (string) config('whatsapp.chat_url');

        if ($apiUrl === '') {
            Log::warning('WhatsApp omitido: falta WHATSAPP_IMAGE_URL o WHATSAPP_CHAT_URL.', [
                'to' => $phone,
                'context' => $context,
            ]);

            return;
        }

        $params = $useImage
            ? [
                'token' => $token,
                'image' => $imageUrl,
                'to' => $phone,
                'caption' => $body,
            ]
            : [
                'token' => $token,
                'to' => $phone,
                'body' => $body,
            ];

        $response = Http::asForm()
            ->timeout(30)
            ->withoutVerifying()
            ->post($apiUrl, $params);

        $httpCode = $response->status();
        $rawBody = $response->body();

        if ($response->failed()) {
            throw new \Exception("HTTP Error ({$httpCode}): ".$rawBody);
        }

        if (! self::apiResponseSucceeded($rawBody, $httpCode)) {
            if ($useImage && self::shouldFallbackToChat($rawBody)) {
                Log::warning('WhatsApp: imagen no disponible, enviando solo texto.', [
                    'to' => $phone,
                    'image' => $imageUrl,
                    'response' => mb_substr($rawBody, 0, 500),
                ]);

                self::sendChatMessage($token, $phone, $body, $context);

                return;
            }

            throw new \Exception(
                'UltraMsg rechazó el envío: '.self::extractApiErrorMessage($rawBody, $httpCode)
            );
        }

        Log::info('WhatsApp enviado correctamente', [
            'to' => $phone,
            'status' => $httpCode,
            'type' => $useImage ? 'image' : 'chat',
            'image' => $useImage ? $imageUrl : null,
            'response' => mb_substr($rawBody, 0, 500),
            'context' => $context,
        ]);
    }

    /**
     * @param  array<string, mixed>  $context
     */
    private static function sendChatMessage(string $token, string $phone, string $body, array $context): void
    {
        $chatUrl = (string) config('whatsapp.chat_url');

        if ($chatUrl === '') {
            throw new \Exception('No hay WHATSAPP_CHAT_URL configurada para el fallback de texto.');
        }

        $response = Http::asForm()
            ->timeout(30)
            ->withoutVerifying()
            ->post($chatUrl, [
                'token' => $token,
                'to' => $phone,
                'body' => $body,
            ]);

        $httpCode = $response->status();
        $rawBody = $response->body();

        if ($response->failed()) {
            throw new \Exception("HTTP Error ({$httpCode}): ".$rawBody);
        }

        if (! self::apiResponseSucceeded($rawBody, $httpCode)) {
            throw new \Exception(
                'UltraMsg rechazó el envío de texto: '.self::extractApiErrorMessage($rawBody, $httpCode)
            );
        }

        Log::info('WhatsApp enviado correctamente (solo texto)', [
            'to' => $phone,
            'status' => $httpCode,
            'context' => $context,
        ]);
    }

    private static function apiResponseSucceeded(mixed $response, int $httpCode): bool
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

    private static function shouldFallbackToChat(mixed $response): bool
    {
        if (! is_string($response)) {
            return false;
        }

        return str_contains($response, 'File not exist')
            || str_contains($response, 'image')
            || str_contains($response, 'download');
    }

    private static function extractApiErrorMessage(mixed $response, int $httpCode): string
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
