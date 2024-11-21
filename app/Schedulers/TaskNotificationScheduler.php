<?php

namespace App\Schedulers;

use Illuminate\Console\Scheduling\Schedule;

class TaskNotificationScheduler
{
    /**
     * Define the schedule.
     */
    public function __invoke(Schedule $schedule): void
    {
        $schedule->command('tasks:notify-due')->daily();
    }
}
