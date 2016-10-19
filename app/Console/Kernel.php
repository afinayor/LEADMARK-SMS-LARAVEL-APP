<?php

namespace leadmark\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
         'leadmark\Console\Commands\AutoBirthday',
        'leadmark\Console\Commands\AutoDates',
        'leadmark\Console\Commands\AutoFrequency',
        'leadmark\Console\Commands\SendQueues',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->command('run:AutoDates')->daily();
        $schedule->command('run:Frequency')->daily();
        $schedule->command('run:birthday')->daily();
        $schedule->command('run:queues')->everyMinute();
    }
}
