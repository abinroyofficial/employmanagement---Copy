<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewTaskCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $task_name;
    public $task_description;
    public $task_deadline;
    public $user_name;
    public $email_id;
    public function __construct($task_name, $task_description, $task_deadline, $user_name, $email_id)
    {
        $this->task_name = $task_name;
        $this->task_description = $task_description;
        $this->task_deadline = $task_deadline;
        $this->user_name = $user_name;
        $this->email_id = $email_id;
    }


    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
