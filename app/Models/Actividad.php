<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'trabajo'];

    public function fechas()
    {
        return $this->hasMany(JobDate::class);
    }

    public function operadores()
    {
        return $this->hasMany(Operator::class);
    }

    public function documentos()
    {
        return $this->hasMany(Document::class);
    }
}

