<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'min:2',
                'regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/'
            ],
            'cpf' => [
                'required',
                'unique:users,cpf',
                'digits:11'
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email'
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&_-])[A-Za-z\d@$!%*?&_-]{8,}$/'
            ],
            'phone' => [
                'nullable',
                'digits:11'
            ]
        ];
    }

    public function messages() : array {
        return [
            'name.required' => 'O name é obrigatório!',
            'name.string' => 'O name deve ser uma string',
            'name.min' => 'O name deve ter pelomenos 2 caracteres',
            'name.regex' => 'O name deve conter apenas letras',

            'cpf.required' => 'O CPF é obrigatório!',
            'cpf.unique' => 'O CPF já está cadastrado!',
            'cpf.digits' => 'O CPF deve conter 11 dígitos',

            'email.required' => 'O e-mail é obrigatório!',
            'email.email' => 'O e-mail deve ser um e-mail válido',
            'email.unique' => 'O e-mail já está cadastrado!',

            'password.required' => 'A senha é obrigatória!',
            'password.string' => 'A senha deve ser uma string',
            'password.min' => 'A senha deve ter pelomenos 8 caracteres',
            'password.regex' => 'A senha deve conter pelo menos uma letra maiúscula, uma minúscula, um número e um caractere especial',

            'phone.digits' => 'O telefone deve conter 11 dígitos'
        ];
    }
}
