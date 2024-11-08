<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OperatorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "ci" => $this->ci,
            "name" => $this->name,
            "is_valid" => !!($this->authorized)? "Autorizado": "No Autorizado",
            "cargo" => $this->role_description
        ];
    }
}
