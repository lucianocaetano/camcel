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
            'enterprise_id' => $this->enterprise_id,
            'hora_entrada' => $this->hora_entrada,
            'hora_salida' => $this->hora_salida,
            'confirmacion_prevencionista' => $this->confirmacion_prevencionista,
            'confirmacion_empresa' => $this->confirmacion_empresa,
            'job_dates' => $this->jobdates,
        ];
    }
}
