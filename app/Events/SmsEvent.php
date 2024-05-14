<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SmsEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $users;

    public function __construct($message,$users)
    {
        $this->users = $users;
        $this->message = $message;

    }

    public function broadcastWith()
    {
        return [
            'users' => $this->users,
            'message' => $this->message
        ];
    }

    public function broadcastAs()
    {
        return 'chating';
    }

    public function broadcastOn()
    {
        return new Channel('PersonalChat');
    }
}
