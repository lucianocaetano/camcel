<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        "url_document",
        "title",
        "expire",
        "is_valid",
        'operator_id',
        'enterprise_id',
        'job_id',
    ];

    function enterprise () {
        return $this->belongsTo(Enterprise::class);
    }
}

