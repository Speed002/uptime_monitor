<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Spatie\ShortSchedule\Facades\ShortSchedule;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    // this is the default laravel scheduler
    protected function schedule(Schedule $schedule): void
    {
        // this is a scheduler that runs checks every after an hour
        // $schedule->command('checks:perform')->hourly();
        // defaults [hourly() and everyMinute()]
        // $schedule->command('checks:perform')->everyMinute();
        // but laravel scheduler now supports sub-minute sheduled tasks
    }

    protected function shortSchedule(ShortSchedule $shortSchedule){
        $shortSchedule->command('checks:perform')->everySecond();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
