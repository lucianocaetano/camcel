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
            'id' => $this->id,
            'trabajo' => $this->trabajo,
           
            'confirmacion_prevencionista' => $this->confirmacion_prevencionista,
            'confirmacion_empresa' => $this->confirmacion_empresa,
            'job_dates' => $this->jobdates,
            "enterprise" => $this->enterprise->nombre,
        ];
    }
}
