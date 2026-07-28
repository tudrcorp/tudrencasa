<?php

return [

    /*
    |--------------------------------------------------------------------------
    | UltraMsg (WhatsApp)
    |--------------------------------------------------------------------------
    |
    | Misma integración que en Integracorp: POST form-urlencoded a la API
    | de UltraMsg. TOKEN y URL de chat deben apuntar a la instancia activa.
    |
    */

    'token' => env('WHATSAPP_TOKEN'),

    'chat_url' => env('WHATSAPP_CHAT_URL'),

    'image_api_url' => env('WHATSAPP_IMAGE_API_URL'),

    /*
    |--------------------------------------------------------------------------
    | Imagen de marca (logo en mensajes)
    |--------------------------------------------------------------------------
    |
    | URL pública del logo. Si no se define, se usa APP_URL + images/whatsapp/tudec-logo.png
    |
    */

    'brand_image_url' => env('WHATSAPP_BRAND_IMAGE_URL'),

    /*
    |--------------------------------------------------------------------------
    | Destinatarios de solicitudes de cotización
    |--------------------------------------------------------------------------
    |
    | Números separados por coma en QUOTE_WHATSAPP_TO.
    |
    */

    'quote_phones' => array_values(array_filter(array_map(
        'trim',
        explode(',', (string) env('QUOTE_WHATSAPP_TO', '+584242220056,+584242271498,+584142073145'))
    ))),

];
