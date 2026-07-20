<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuoteFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'required_without:email', 'string', 'max:40'],
            'email' => ['nullable', 'required_without:phone', 'email', 'max:255'],
            'state' => ['required', 'string', 'max:120'],
            'city' => ['required', 'string', 'max:120'],
            'observations' => ['nullable', 'string', 'max:2000'],
            // Honeypot: los humanos lo dejan vacío; los bots suelen rellenarlo.
            'website' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'phone.required_without' => 'Indica al menos un teléfono o un correo electrónico.',
            'email.required_without' => 'Indica al menos un teléfono o un correo electrónico.',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'full_name' => 'nombre y apellido',
            'phone' => 'teléfono',
            'email' => 'correo electrónico',
            'state' => 'estado',
            'city' => 'ciudad',
            'observations' => 'observaciones',
        ];
    }
}
