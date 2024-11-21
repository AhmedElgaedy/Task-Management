<?php

namespace App\Console\Commands;

use App\Mail\TaskDueNotification;
use App\Models\Task;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class NotifyUsersAboutDueTasks extends Command
{
    protected $signature = 'tasks:notify-due';
    protected $description = 'Notify users about tasks due within the next 24 hours';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tasks = Task::where('due_date', '<=', Carbon::now()->addDay())
            ->where('due_date', '>', now())
            ->get();

        foreach ($tasks as $task) {
            Mail::to($task->user->email)->queue(new TaskDueNotification($task));
            $this->info("Notification sent for task ID {$task->id} to {$task->user->email}");
        }

        $this->info('All due task notifications have been sent.');
    }
}
