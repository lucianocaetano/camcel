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
        'confirmacion_prevencionista',
        'confirmacion_empresa',
        "enterprise_id"
    ];

    public function jobdates()
    {
        return $this->hasMany(JobDate::class, 'job_id');
    }

    public function enterprise(){
        return $this->belongsTo(Enterprise::class);
    }
}
