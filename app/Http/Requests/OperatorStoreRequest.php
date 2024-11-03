<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OperatorStoreRequest extends FormRequest
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
            "cedula" => ["required", "string", "max:44"],
            "nombre" => ["required", "string", "max:50"],
            "autorizado" => ["required", "boolean"],
            "role_description"  => ["required", "string",],
            'enterprise_id' => ["required", "exists:enterprises,id"],
        ];
    }
}
