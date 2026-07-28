<?php

declare(strict_types=1);

namespace App\Support;

use App\Jobs\SendNotificacionWhatsApp;
use App\Support\WhatsAppBrandImage;

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
            SendNotificacionWhatsApp::dispatch(
                $body,
                $phone,
                ['source' => 'quote.store'],
                $imageUrl,
            );
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
}
