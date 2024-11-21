<?php

namespace App\Mail;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TaskDueNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $task;

    /**
     * Create a new message instance.
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Task Due Notification')
                    ->view('emails.task_due_notification')
                    ->with([
                        'title' => $this->task->title,
                        'dueDate' => $this->task->due_date,
                        'description' => $this->task->description,
                    ]);
    }
}
