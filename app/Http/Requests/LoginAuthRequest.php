<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginAuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
            ],
            'password' => [
                'required',
            ],
        ];
    }
    public function messages() : array {
        return [
            'email.required' => 'O e-mail é obrigatório!',
            'email.email' => 'O e-mail deve ser um e-mail válido',

            'password.required' => 'A senha é obrigatória!',
        ];
    }
}
