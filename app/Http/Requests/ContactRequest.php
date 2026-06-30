<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reguli de validare pentru formularul de contact.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email:rfc', 'max:180'],
            'phone' => ['nullable', 'string', 'max:30'],
            'service' => ['nullable', 'string', 'max:60'],
            'message' => ['required', 'string', 'min:10', 'max:3000'],
            'consent' => ['accepted'],
            // Honeypot anti-spam: trebuie să rămână gol.
            'website' => ['nullable', 'prohibited'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => __('contact.fields.name'),
            'email' => __('contact.fields.email'),
            'phone' => __('contact.fields.phone'),
            'service' => __('contact.fields.service'),
            'message' => __('contact.fields.message'),
            'consent' => __('contact.fields.consent'),
        ];
    }
}
