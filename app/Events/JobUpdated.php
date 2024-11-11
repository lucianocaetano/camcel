<?php

namespace App\Events;

use App\Models\Job;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class JobUpdated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $job;

    /**
     * Crea una nueva instancia del evento.
     *
     * @param Job $job
     * @return void
     */
    public function __construct(Job $job)
    {
        $this->job = $job;
    }

    /**
     * El canal por el que se emitirá el evento.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('jobs-channel');
    }

    /**
     * Los datos que se transmitirán con el evento.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'job' => $this->job,  // Asegúrate de pasar correctamente los datos del trabajo
        ];
    }
}