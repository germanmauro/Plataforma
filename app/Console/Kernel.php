<?php

namespace App\Console;

use App\Models\Notification;
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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        
        $schedule->call(function() {
            $not = new Notification();
            $not->register(1,"prueba","prueba 1 minuto");
            $not->save();
        }
    )->everyFiveMinutes();
        $schedule->call(
            function () {
                $not = new Notification();
                $not->register(1, "prueba", "prueba 5 minutos");
                $not->save();
            }
        )->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
