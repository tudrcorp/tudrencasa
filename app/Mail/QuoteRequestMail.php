<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuoteRequestMail extends Mailable
{
    use SerializesModels;

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

    public function envelope(): Envelope
    {
        $fullName = (string) ($this->payload['full_name'] ?? 'Sin nombre');

        return new Envelope(
            subject: "Nueva solicitud de cotización — {$fullName}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.quote-request',
            with: [
                'headline' => 'Nueva solicitud de cotización',
                'intro' => 'Se recibió una nueva solicitud desde el formulario “Cotiza con nosotros”.',
                'details' => $this->details(),
                'accentColor' => '#2D89CA',
            ],
        );
    }

    /**
     * @return array<string, string>
     */
    public function details(): array
    {
        $payload = $this->payload;

        return [
            'Nombre y Apellido' => (string) ($payload['full_name'] ?? '—'),
            'Teléfono' => filled($payload['phone'] ?? null) ? (string) $payload['phone'] : '—',
            'Correo electrónico' => filled($payload['email'] ?? null) ? (string) $payload['email'] : '—',
            'Estado' => (string) ($payload['state'] ?? '—'),
            'Ciudad' => (string) ($payload['city'] ?? '—'),
            'Observaciones' => filled($payload['observations'] ?? null) ? (string) $payload['observations'] : '—',
        ];
    }
}
