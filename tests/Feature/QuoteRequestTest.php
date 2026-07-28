<?php

use App\Jobs\SendNotificacionWhatsApp;
use App\Mail\QuoteRequestMail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;

beforeEach(function () {
    // El throttle usa cache; hay que limpiarlo entre tests del mismo proceso.
    Cache::flush();
    $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class);
});

it('envía la solicitud de cotización y el correo con todos los datos', function () {
    Mail::fake();
    Queue::fake();

    $payload = [
        'full_name' => 'Ana Pérez',
        'phone' => '04121234567',
        'email' => 'ana@example.com',
        'state' => 'Miranda',
        'city' => 'Caracas',
        'observations' => 'Necesito cobertura familiar',
    ];

    $response = $this->postJson(route('quote.store'), $payload);

    $response
        ->assertSuccessful()
        ->assertJsonStructure(['message']);

    Mail::assertSent(QuoteRequestMail::class, function (QuoteRequestMail $mail) use ($payload) {
        expect($mail->envelope()->subject)->toBe('Nueva solicitud de cotización — Ana Pérez');
        expect($mail->details())->toMatchArray([
            'Nombre y Apellido' => 'Ana Pérez',
            'Teléfono' => '04121234567',
            'Correo electrónico' => 'ana@example.com',
            'Estado' => 'Miranda',
            'Ciudad' => 'Caracas',
            'Observaciones' => 'Necesito cobertura familiar',
        ]);

        return $mail->hasTo('comercial@tudrencasa.com')
            && $mail->hasCc('solrodriguez@tudrencasa.com')
            && $mail->hasCc('aaular@tudrencasa.com')
            && $mail->payload === $payload;
    });

    Queue::assertPushed(SendNotificacionWhatsApp::class, 3);

    Queue::assertPushed(SendNotificacionWhatsApp::class, function (SendNotificacionWhatsApp $job) {
        return in_array($job->phone, ['+584242220056', '+584242271498', '+584142073145'], true)
            && str_contains($job->body, 'Ana Pérez')
            && str_contains($job->body, '04121234567')
            && str_contains($job->body, 'ana@example.com');
    });
});

it('rechaza una solicitud incompleta y no envía correo', function () {
    Mail::fake();
    Queue::fake();

    $response = $this->postJson(route('quote.store'), [
        'full_name' => '',
        'email' => 'no-es-un-email',
        'state' => '',
        'city' => '',
    ]);

    $response
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['full_name', 'email', 'state', 'city']);

    Mail::assertNothingSent();
    Queue::assertNothingPushed();
});

it('exige al menos un teléfono o un correo', function () {
    Mail::fake();
    Queue::fake();

    $response = $this->postJson(route('quote.store'), [
        'full_name' => 'Luis Gómez',
        'state' => 'Zulia',
        'city' => 'Maracaibo',
    ]);

    $response
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['phone', 'email']);

    Mail::assertNothingSent();
    Queue::assertNothingPushed();
});

it('acepta solicitud con teléfono y sin correo', function () {
    Mail::fake();
    Queue::fake();

    $payload = [
        'full_name' => 'Luis Gómez',
        'phone' => '04141234567',
        'state' => 'Zulia',
        'city' => 'Maracaibo',
    ];

    $this->postJson(route('quote.store'), $payload)->assertSuccessful();

    Mail::assertSent(QuoteRequestMail::class, function (QuoteRequestMail $mail) {
        return $mail->hasTo('comercial@tudrencasa.com')
            && $mail->hasCc('solrodriguez@tudrencasa.com')
            && $mail->hasCc('aaular@tudrencasa.com')
            && $mail->payload['full_name'] === 'Luis Gómez';
    });

    Queue::assertPushed(SendNotificacionWhatsApp::class, 3);
});

it('no envía correo ni WhatsApp si el honeypot está rellenado', function () {
    Mail::fake();
    Queue::fake();

    $response = $this->postJson(route('quote.store'), [
        'full_name' => 'Bot Spam',
        'phone' => '04121234567',
        'state' => 'Miranda',
        'city' => 'Caracas',
        'website' => 'http://spam.example',
    ]);

    $response
        ->assertSuccessful()
        ->assertJsonStructure(['message']);

    Mail::assertNothingSent();
    Queue::assertNothingPushed();
});

it('limita el ritmo de envíos del formulario de cotización', function () {
    Mail::fake();
    Queue::fake();

    $payload = [
        'full_name' => 'Ana Pérez',
        'phone' => '04121234567',
        'state' => 'Miranda',
        'city' => 'Caracas',
    ];

    for ($i = 0; $i < 5; $i++) {
        $this->postJson(route('quote.store'), $payload)->assertSuccessful();
    }

    $this->postJson(route('quote.store'), $payload)->assertStatus(429);
});
