<?php

declare(strict_types=1);

namespace App\Support;

final class WhatsAppBrandImage
{
    public const RELATIVE_PATH = 'images/logoNewTDEC.png';

    public static function publicUrl(): string
    {
        $configured = trim((string) config('whatsapp.brand_image_url'));

        if ($configured !== '') {
            return $configured;
        }

        return rtrim((string) config('app.url'), '/').'/'.self::RELATIVE_PATH;
    }
}
