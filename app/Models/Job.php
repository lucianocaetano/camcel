<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "slug",
        "description",
        "is_check",
        "date",
        "in_time",
        "out_time",
        'RUT_enterprise',
    ];

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class);
    }

}
