<?php

namespace App\Http\Requests;

use App\Http\Requests\UserStoreRequest;
use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends UserStoreRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = parent::rules();

        $rules['password'] = [
            'nullable',
            'string',
            'min:8',
            'regex:/^(?=.*[@$!%*?&_-])(?=.*[A-Z])(?=.*\d).{8,}$/'
        ];
        return $rules;
    }
}
