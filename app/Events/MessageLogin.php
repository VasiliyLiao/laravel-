<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageLogin extends Event implements ShouldBroadcast
{
    use SerializesModels;

    private $username = null;

    public function __construct($username)
    {
        $this->username = $username;
        $this->message = $message;
    }

    public function broadcastWith()
    {
        return [
            'username' => $this->username,
            'message' => $this->message,
        ];
    }
    
    public function broadcastOn()
    {
        return ['chat-channel'];
    }
}
