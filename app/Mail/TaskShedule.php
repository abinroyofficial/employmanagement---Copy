<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TaskShedule extends Mailable
{
    use Queueable, SerializesModels;

    public $task_name;
    public $task_description;
    public $task_deadline;
    public $user_name;
    public function __construct($task_name, $task_description, $task_deadline,$user_name)
    {
        $this->task_name = $task_name;
        $this->task_description = $task_description;
        $this->task_deadline = $task_deadline;
        $this->user_name = $user_name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Task Shedule',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.TaskShedule',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
