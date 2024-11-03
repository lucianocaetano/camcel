<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobDate extends Model
{
    use HasFactory;

    protected $fillable = ['job_id', 'fecha'];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
