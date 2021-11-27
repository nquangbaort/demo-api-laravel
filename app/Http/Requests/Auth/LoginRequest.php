<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email', 'max:' . FORM_INPUT_MAX_LENGTH],
            'password' => ['required', 'max:' . FORM_INPUT_MAX_LENGTH]
        ];
    }
}
