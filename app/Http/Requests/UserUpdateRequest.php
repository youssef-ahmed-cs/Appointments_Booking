<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $this->route('user'),
            'password' => 'sometimes|required|string|min:8',
            'role' => 'sometimes|required|string|in:client,provider',
            'phone' => 'sometimes|required|string|max:15',
        ];
    }
}
