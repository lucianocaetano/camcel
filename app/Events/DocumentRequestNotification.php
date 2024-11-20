<?php
use App\Models\RequestedDocument;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class DocumentRequestNotification implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $requestedDocument;

    public function __construct(RequestedDocument $requestedDocument)
    {
        $this->requestedDocument = $requestedDocument;
    }

    public function broadcastOn()
    {
        return ['document-requests'];
    }

    public function broadcastAs()
    {
        return 'document-requested';
    }
}
