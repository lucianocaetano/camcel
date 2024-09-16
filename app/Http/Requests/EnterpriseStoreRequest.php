<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnterpriseStoreRequest extends FormRequest
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
<<<<<<< HEAD
            "RUT" => ["string", "required", "unique:enterprises"],
            "nombre" => ["string", "required"],
            "slug" => ["string", "required"],
            "is_valid" => ["bool", "required"],
=======
            "RUT" => ["string", "required"],
            "nombre" => ["string", "required"], 
            "slug" => ["string", "required"], 
            "is_valid" => ["bool", "required"], 
            "image" => ["image", "mimes:jpeg,png,jpg,gif,svg"], 
            "user_id" => ["required", "unique:users"]
>>>>>>> actividades_calendario
        ];
    }

    public function prepareForValidation() {
        $this->merge(
            [
<<<<<<< HEAD
                "slug" => str($this->nombre." ".uniqid())->slug()->value()
            ]
        );
    }
}
=======
                "slug" => str($this->slug." ".uniqid())->slug()
            ]
        );
    }
>>>>>>> actividades_calendario
