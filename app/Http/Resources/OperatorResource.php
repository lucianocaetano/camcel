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
            "cedula" => $this->cedula,
            "nombre" => $this->nombre,
            "autorizado" => ($this->autorizado === 1) ? "Autorizado": "No autorizado",
            "cargo" => $this->role_description
        ];
    }
}
