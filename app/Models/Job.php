<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'trabajo',
        'enterprise_id',
        'hora_entrada',
        'hora_salida',
        'confirmacion_prevencionista',
        'confirmacion_empresa',
    ];

    public function jobdates()
    {
        return $this->hasMany(JobDate::class, 'job_id');
    }
}
