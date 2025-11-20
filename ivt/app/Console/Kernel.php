<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\SendWeeklyTicketReport; // Import the command class

class Kernel extends ConsoleKernel
{
    protected $commands = [
        SendWeeklyTicketReport::class, // Register the command here
    ];
    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // ... other schedules

        // Schedule the command
        $schedule->command('report:tickets-weekly')
                // ->mondays() // Changed to Monday
                // ->at('08:36')
                 //->weeklyOn(2, '12:55') // For testing purposes, you can set it to 12:55 PM on Tuesdays
                // ->weeklyOn(6, '08:02') // Set to run every Saturday at 08:02 AM 
                // ->dailyAt('07:58') // For testing purposes, you can set it to 1:55 PM daily
                //  ->everyMinute() // For testing purposes, you can set it to run every minute
                 //->hourly() // For testing purposes, you can set it to run hourly
                 //->twiceDaily(9, 17) // For testing purposes, you can set it to run twice daily at 9 AM and 5 PM
                 ->withoutOverlapping() 
                 ->emailOutputOnFailure('jarisibertech@gmail.com'); // Optional: notify admin if it fails
    }

    // ... rest of the file
}
