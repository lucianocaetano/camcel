<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\JobUpdated;

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
    protected static function boot()
    {
        parent::boot();

        static::updating(function ($job) {
            // Trigger the event before the job is updated
            event(new JobUpdated($job));
        });

        static::updated(function ($job) {
            // You can also trigger the event after the job is updated if needed
            event(new JobUpdated($job));
        });
    }
}
