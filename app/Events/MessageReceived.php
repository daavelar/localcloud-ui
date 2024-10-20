<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageReceived implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private mixed $messageId;

    public function __construct($messageId)
    {
        $this->messageId = $messageId;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('messages'),
        ];
    }
}
