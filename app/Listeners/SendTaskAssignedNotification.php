<?php
namespace App\Listeners;

use App\Events\NewTaskCreatedEvent;
use App\Models\User;
use App\Notifications\TaskAssignedNotification;

class SendTaskAssignedNotification
{
    public function handle(NewTaskCreatedEvent $event)
    {
        // Get the user by email
        $user = User::where('email', $event->email_id)->first();

        if ($user) {
            $user->notify(new TaskAssignedNotification(
                $event->task_name,
                $event->task_description,
                $event->task_deadline,
                $event->taskId
            ));
        }
    }
}
