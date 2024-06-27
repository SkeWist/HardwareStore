<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends ApiRequest
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
            'surname' => 'string|min:2|max:32',
            'name' => 'string|min:2|max:32',
            'phone' => 'string|regex:/^8\d{3}\d{3}\d{2}\d{2}$/',
            'password' => 'string|min:6|max:128',
            'role_id' => 'integer|exists:roles,id'
        ];
    }
}
