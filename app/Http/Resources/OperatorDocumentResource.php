<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OperatorDocumentResource extends JsonResource
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
            "url_document" => $this->url_document,
            "title" => $this->title,
            "expire" => $this->expire,
            "is_valid" => !!($this->is_valid),
            'operator' => $this->operator->name,
            "links" => [
                'self' => route('operators.documents.show', ['enterprise' => $this->operator->enterprise->slug, "operator" => $this->operator->id, "document" => $this->id]),
                'operator' => route('operators.show', ['enterprise' => $this->operator->enterprise->slug, "operator" => $this->operator->id]),
            ]
        ];
    }
}
