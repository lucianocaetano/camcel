<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnterpriseUpdateRequest extends FormRequest
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
            "nombre" => ["string", "required"],
            "is_valid" => ["bool", "required"],
            "image" => ["nullable", "image"],
            "user_id" => ["nullable", "exists:users,id"]
        ];
    }

    public function prepareForValidation()
    {

        $this->merge([
            'is_valid' => filter_var($this->is_valid, FILTER_VALIDATE_BOOLEAN)
        ]);

        $this->merge(
            [
                "slug" => str($this->nombre . " " . uniqid())->slug()->value()
            ]
        );
    }
}
