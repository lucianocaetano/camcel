<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title" => ["string"],
            "slug" => ["string"],
            "is_check" => ["boolean"],
            "is_check_enterprise" => ["boolean"],
            "fechas" => ["array"], // Cambiado para aceptar un array de fechas
            "fechas.*" => ["date"], // Valida cada fecha individualmente
            "in_time" => ["date_format:H:i", "required"],
            "out_time" => ["date_format:H:i", "required"],
            'RUT_enterprise' => ["string", "exists:enterprises,RUT"],
        ];
    }

    public function prepareForValidation() {
        $this->merge(
            [
                "slug" => str($this->title." ".uniqid())->slug()->value()
            ]
        );
    }
}
