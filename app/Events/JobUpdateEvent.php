<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class JobUpdateEvent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $job;

    public function __construct($job)
    {
        $this->job = $job;
        \Log::info('Evento JobUpdateEvent emitido', ['job_id' => $job->id]);
    }

    public function broadcastOn()
    {
        return new \Illuminate\Broadcasting\Channel('jobs-channel');
    }

    public function broadcastAs()
    {
        return 'job-updated';
    }
}
