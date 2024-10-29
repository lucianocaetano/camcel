<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Autorizar solo si el usuario tiene permisos
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email',
            'password' => 'nullable|string|min:8',
            'rol' => 'string|in:Admin,Enterprise,Guard',
        ];
    }
}
