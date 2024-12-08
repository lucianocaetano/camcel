<?php

namespace App\Http\Resources\Pagination;

use App\Http\Resources\EnterpriseResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EnterprisesPaginatedCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public $collects = EnterpriseResource::class;

    public function toArray(Request $request): array
    {
        return [
            "enterprises" => $this->collection,
            'links' => [
                'first' => $this->url(1),
                'last' => $this->url($this->lastPage()),
                'prev' => $this->previousPageUrl(),
                'next' => $this->nextPageUrl(),
            ],
            'meta' => [
                'current_page' => $this->currentPage(),
                'from' => $this->firstItem(),
                'last_page' => $this->lastPage(),
                'path' => $this->path(),
                'per_page' => $this->perPage(),
                'last_item' => $this->lastItem(),
                'total' => $this->total(),
            ],
        ];
    }
}
