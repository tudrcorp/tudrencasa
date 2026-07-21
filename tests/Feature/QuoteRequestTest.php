<?php

use App\Mail\QuoteRequestMail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

beforeEach(function () {
    // El throttle usa cache; hay que limpiarlo entre tests del mismo proceso.
    Cache::flush();
});

it('envía la solicitud de cotización y el correo con todos los datos', function () {
    Mail::fake();

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
});

it('rechaza una solicitud incompleta y no envía correo', function () {
    Mail::fake();

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
});

it('exige al menos un teléfono o un correo', function () {
    Mail::fake();

    $response = $this->postJson(route('quote.store'), [
        'full_name' => 'Luis Gómez',
        'state' => 'Zulia',
        'city' => 'Maracaibo',
    ]);

    $response
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['phone', 'email']);

    Mail::assertNothingSent();
});

it('acepta solicitud con teléfono y sin correo', function () {
    Mail::fake();

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
});

it('no envía correo si el honeypot está rellenado', function () {
    Mail::fake();

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
});

it('limita el ritmo de envíos del formulario de cotización', function () {
    Mail::fake();

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
