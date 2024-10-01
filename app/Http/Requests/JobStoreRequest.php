<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobStoreRequest extends FormRequest
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
            "title" => ["required", "string"],
            "slug" => ["required", "string"],
            "is_check" => ["required", "bool"],
            "is_check_enterprise" => ["required", "bool"],
            "date" => ["date", "required"],
            "in_time" => ["date_format:H:i", "required"],
            "out_time" => ["date_format:H:i", "required"],
            'RUT_enterprise' => ["required", "string", "exists:enterprises,RUT"],
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
