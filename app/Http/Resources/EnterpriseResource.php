<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnterpriseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "RUT" => $this->RUT,
            "slug" => $this->slug,
            "nombre" => $this->nombre,
            "image" => $this->image,
            "is_valid" => !!($this->is_valid),
            "user" => UserResource::make($this->user),
            'links' => [
                'self' => route('enterprises.show', ['enterprise' => $this->id]),
                'operators' => route('operators.index', ['enterprise' => $this->slug]),
                'documents' => route('documents.index', ['enterprise' => $this->slug]),
            ],
        ];
    }
}
