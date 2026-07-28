<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\QuoteFormRequest;
use App\Mail\QuoteRequestMail;
use App\Support\QuoteWhatsAppNotifier;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class QuoteController extends Controller
{
    private const EMAIL_TO = 'comercial@tudrencasa.com';

    private const EMAIL_CC = [
        'solrodriguez@tudrencasa.com',
        'aaular@tudrencasa.com',
    ];

    public function store(QuoteFormRequest $request): JsonResponse
    {
        $success = [
            'message' => 'Tu solicitud de cotización fue enviada correctamente. Te contactaremos pronto.',
        ];

        // Honeypot rellenado: respuesta exitosa sin enviar correo (no tipar al bot).
        if (filled($request->input('website'))) {
            return response()->json($success);
        }

        /** @var array{full_name: string, phone?: string|null, email?: string|null, state: string, city: string, observations?: string|null} $data */
        $data = $request->safe()->except(['website']);

        try {
            Mail::to(self::EMAIL_TO)
                ->cc(self::EMAIL_CC)
                ->send(new QuoteRequestMail($data));

            Log::info('QUOTE-REQUEST: correo enviado.', [
                'to' => self::EMAIL_TO,
                'cc' => self::EMAIL_CC,
            ]);
        } catch (Throwable $exception) {
            // No bloquear WhatsApp ni la respuesta al usuario si SMTP falla (red/firewall).
            Log::error('QUOTE-REQUEST: fallo al enviar correo de cotización.', [
                'request_hash' => substr(hash('sha256', (string) ($data['full_name'] ?? '')), 0, 12),
                'error' => $exception->getMessage(),
            ]);
        }

        QuoteWhatsAppNotifier::notify($data);

        return response()->json($success);
    }
}
