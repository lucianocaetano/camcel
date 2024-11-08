<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use HasFactory;

    protected $fillable = [
        "cedula",
        "nombre",
        "autorizado",
        "role_description",
        'enterprise_id'
    ];


    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class);
    }

    public function documents () {
        return $this->hasMany(Document::class);
    }
}
