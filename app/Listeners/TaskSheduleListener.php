<?php

namespace App\Listeners;

use App\Events\NewTaskCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskShedule;

class TaskSheduleListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewTaskCreatedEvent $event): void
    {
        Mail::to($event->email_id)
            ->cc('abinroy4321@gmail.com')
            ->send(new TaskShedule(
                $event->task_name,
                $event->task_description,
                $event->task_deadline,
                $event->user_name
            ));
    }
}
