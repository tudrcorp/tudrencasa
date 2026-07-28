<?php

use App\Mail\QuoteRequestMail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

beforeEach(function () {
    // El throttle usa cache; hay que limpiarlo entre tests del mismo proceso.
    Cache::flush();
    $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class);
});

it('envía la solicitud de cotización y el correo con todos los datos', function () {
    Mail::fake();
    Http::fake([
        'https://example.test/messages/chat' => Http::response(['sent' => 'true', 'id' => 'msg-1'], 200),
    ]);

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

    Http::assertSentCount(3);

    Http::assertSent(function (\Illuminate\Http\Client\Request $request) {
        $data = $request->data();

        return $request->url() === 'https://example.test/messages/chat'
            && in_array($data['to'] ?? null, ['+584242220056', '+584242271498', '+584142073145'], true)
            && str_contains((string) ($data['body'] ?? ''), 'Ana Pérez')
            && str_contains((string) ($data['body'] ?? ''), '04121234567')
            && str_contains((string) ($data['body'] ?? ''), 'ana@example.com');
    });
});

it('rechaza una solicitud incompleta y no envía correo', function () {
    Mail::fake();
    Http::fake();

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
    Http::assertNothingSent();
});

it('exige al menos un teléfono o un correo', function () {
    Mail::fake();
    Http::fake();

    $response = $this->postJson(route('quote.store'), [
        'full_name' => 'Luis Gómez',
        'state' => 'Zulia',
        'city' => 'Maracaibo',
    ]);

    $response
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['phone', 'email']);

    Mail::assertNothingSent();
    Http::assertNothingSent();
});

it('acepta solicitud con teléfono y sin correo', function () {
    Mail::fake();
    Http::fake([
        'https://example.test/messages/chat' => Http::response(['sent' => 'true', 'id' => 'msg-2'], 200),
    ]);

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

    Http::assertSentCount(3);
});

it('no envía correo ni WhatsApp si el honeypot está rellenado', function () {
    Mail::fake();
    Http::fake();

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
    Http::assertNothingSent();
});

it('si el correo falla, igual envía WhatsApp y responde éxito', function () {
    $pending = Mockery::mock();
    $pending->shouldReceive('cc')->andReturnSelf();
    $pending->shouldReceive('send')->andThrow(new Exception('SMTP connection failed'));

    Mail::shouldReceive('to')->once()->andReturn($pending);
    Log::spy();
    Http::fake([
        'https://example.test/messages/chat' => Http::response(['sent' => 'true', 'id' => 'msg-mail-fail'], 200),
    ]);

    $payload = [
        'full_name' => 'Ana Pérez',
        'phone' => '04121234567',
        'state' => 'Miranda',
        'city' => 'Caracas',
    ];

    $this->postJson(route('quote.store'), $payload)
        ->assertSuccessful()
        ->assertJsonStructure(['message']);

    Log::shouldHaveReceived('error')
        ->withArgs(fn (string $message) => str_contains($message, 'fallo al enviar correo'))
        ->atLeast()
        ->once();

    Http::assertSentCount(3);
});

it('si UltraMsg falla, igual responde éxito tras enviar el correo', function () {
    Mail::fake();
    Log::spy();
    Http::fake([
        'https://example.test/messages/chat' => Http::response(['error' => 'rate limit'], 200),
    ]);

    $payload = [
        'full_name' => 'Ana Pérez',
        'phone' => '04121234567',
        'state' => 'Miranda',
        'city' => 'Caracas',
    ];

    $this->postJson(route('quote.store'), $payload)
        ->assertSuccessful()
        ->assertJsonStructure(['message']);

    Mail::assertSent(QuoteRequestMail::class);

    Log::shouldHaveReceived('error')
        ->withArgs(fn (string $message) => str_contains($message, 'fallo al enviar WhatsApp'))
        ->atLeast()
        ->once();
});

it('limita el ritmo de envíos del formulario de cotización', function () {
    Mail::fake();
    Http::fake([
        'https://example.test/messages/chat' => Http::response(['sent' => 'true', 'id' => 'msg-3'], 200),
    ]);

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
