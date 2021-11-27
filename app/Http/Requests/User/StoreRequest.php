<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'             => ['uuid'],
            'name'           => ['required', 'max:' . FORM_INPUT_MAX_LENGTH],
            'email'          => [
                'required_if:id,null', 'email', 'max:' . FORM_INPUT_MAX_LENGTH,
                'unique:users,email' . ($this->id != null ? ",$this->id" : ''),
            ],
            'password'       => ['required_with:password_confirmation', 'min:6', 'confirmed'],
            'company_id'     => ['required', 'numeric'],
            'is_super_admin' => ['boolean'],
            'role'           => [Rule::in([SUPER_ADMIN_ROLE, ADMIN_ROLE, USER_ROLE])],
            'avatar'         => 'image',
        ];
    }
}
