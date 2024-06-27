<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends ApiRequest
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
            'surname' => 'required|string|min:2|max:32',
            'name' => 'required|string|min:2|max:32',
            'phone' => 'required|string|unique:users|regex:/^8\d{3}\d{3}\d{2}\d{2}$/',
            'password' => 'required|string|min:6',
        ];
    }
}
