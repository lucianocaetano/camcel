<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "name" => $this->name,
            "email" => $this->email,
            "rol" => $this->rol === "Enterprise" ? ($this->enterprises? "Empresario": "Empresario sin empresa") : ($this->rol === "Guard"? "Guardia": $this->rol),
            "id" => $this->id
        ];
    }
}
