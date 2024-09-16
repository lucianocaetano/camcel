<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "name" => $this->name,
            "description" => $this->description,
            "is_check" => $this->is_check,
            "date" => $this->date,
            "in_time" => $this->in_time,
            "out_time"=> $this->out_time,
            'name_enterprise' => $this->enterprise->nombre,
            'contact_businessman' => $this->enterprise->user->email,
        ];
    }
}
