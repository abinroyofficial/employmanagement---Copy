<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TaskAssignedNotification extends Notification
{
    use Queueable;

    public $taskName;
    public $taskDescription;
    public $taskDeadline;
    public $taskId;

    public function __construct($taskName, $taskDescription, $taskDeadline,$taskId)
    {
        $this->taskName = $taskName;
        $this->taskDescription = $taskDescription;
        $this->taskDeadline = $taskDeadline;
        $this->taskId = $taskId;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "You have been assigned a new task: {$this->taskName}",
            'description' => $this->taskDescription,
            'deadline' => $this->taskDeadline,
            'id' => $this->taskId,
        ];
    }
}
