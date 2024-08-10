<?php

namespace App\Models;

use App\Models\Operator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    use HasFactory;

    protected $fillable = [
        "RUT",
        "nombre",
        "slug",
        "image",
        "is_valid",
        "user_id"
    ];

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function operators()
    {
        return $this->hasMany(Operator::class);
    }
}
