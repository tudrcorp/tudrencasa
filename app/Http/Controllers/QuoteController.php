<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\QuoteFormRequest;
use App\Jobs\SendQuoteRequestMailJob;
use Illuminate\Http\JsonResponse;

class QuoteController extends Controller
{
    public function store(QuoteFormRequest $request): JsonResponse
    {
        $success = [
            'message' => 'Tu solicitud de cotización fue enviada correctamente. Te contactaremos pronto.',
        ];

        // Honeypot rellenado: respuesta exitosa sin encolar correo (no tipar al bot).
        if (filled($request->input('website'))) {
            return response()->json($success);
        }

        /** @var array{full_name: string, phone?: string|null, email?: string|null, state: string, city: string, observations?: string|null} $data */
        $data = $request->safe()->except(['website']);

        SendQuoteRequestMailJob::dispatch($data);

        return response()->json($success);
    }
}
