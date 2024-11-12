<?php

namespace App\Listeners;

use App\Events\JobUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class JobUpdatedListener implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    public function handle(JobUpdated $event)
    {
        // Aquí puedes manejar el evento, por ejemplo, enviar una notificación
        \Log::info('Job updated: ', ['job' => $event->job]);
    }
}