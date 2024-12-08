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
            "is_valid" => !!($this->authorized),
            "enterprise" => $this->enterprise->slug,
            "cargo" => $this->role_description,
            "links" => [
                'self' => route('operators.show', ['enterprise' => $this->enterprise->slug, "operator" => $this->id]),
                'enterprise' => route('enterprises.show', ['enterprise' => $this->enterprise->slug]),
                'documents' => route('operators.documents.index', ["enterprise" => $this->enterprise->slug, 'operator' => $this->id]),
            ]
        ];
    }
}
