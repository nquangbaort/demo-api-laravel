<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchRequest extends FormRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'include' => Rule::in(['company']),
            'name' => ['nullable', 'max:' . FORM_INPUT_MAX_LENGTH],
            'name_kana' => ['nullable', 'max:' . FORM_INPUT_MAX_LENGTH],
            'email' => ['nullable', 'max:' . FORM_INPUT_MAX_LENGTH],
        ];
    }
}
