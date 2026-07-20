<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Mail\QuoteRequestMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendQuoteRequestMailJob implements ShouldQueue
{
    use Queueable;

    public int $tries = 5;

    private const DEFAULT_CC = [
        'solrodriguez@tudrencasa.com',
        'aaular@tudrencasa.com',
    ];

    /**
     * @param  array{
     *     full_name: string,
     *     phone?: string|null,
     *     email?: string|null,
     *     state: string,
     *     city: string,
     *     observations?: string|null
     * }  $payload
     */
    public function __construct(public array $payload) {}

    /**
     * @return array<int, int>
     */
    public function backoff(): array
    {
        return [10, 30, 60, 120, 300];
    }

    public function handle(): void
    {
        $to = config('mail.quote_request_to');

        if (! is_string($to) || $to === '') {
            Log::error('QUOTE-REQUEST: destinatario no configurado (mail.quote_request_to).');

            return;
        }

        $cc = $this->resolveCc();

        try {
            Mail::to($to)->cc($cc)->send(new QuoteRequestMail($this->payload));

            Log::info('QUOTE-REQUEST: correo enviado.', [
                'to' => $to,
                'cc' => $cc,
            ]);
        } catch (Throwable $exception) {
            Log::error('QUOTE-REQUEST: fallo al enviar correo de cotización.', [
                'request_hash' => substr(hash('sha256', (string) ($this->payload['full_name'] ?? '')), 0, 12),
                'error' => $exception->getMessage(),
            ]);

            throw $exception;
        }
    }

    /**
     * @return list<string>
     */
    private function resolveCc(): array
    {
        $cc = config('mail.quote_request_cc', []);

        if (! is_array($cc)) {
            return self::DEFAULT_CC;
        }

        $cc = array_values(array_filter($cc, static fn ($email): bool => is_string($email) && $email !== ''));

        return $cc !== [] ? $cc : self::DEFAULT_CC;
    }
}
