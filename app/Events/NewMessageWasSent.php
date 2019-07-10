<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewMessageWasSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $new_message;
    public $room_id;

    public function __construct($new_message, $room_id)
    {
        $this->new_message = $new_message;
        $this->room_id = $room_id;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('new-message-for-room-' . $this->room_id);
    }
}
