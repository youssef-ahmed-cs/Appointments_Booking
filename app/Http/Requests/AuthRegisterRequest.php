<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'unique|string|max:255',
            'email' => 'email|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}
