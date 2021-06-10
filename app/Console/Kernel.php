<?php

namespace App\Console;

use App\Http\Controllers\CronController;
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
        // //Cada minuto
        $schedule->call(
            function () {
                CronController::thirtyMinClassAlert();
            }
        )->everyMinute()->name("alerta30min")->withoutOverlapping();

        $schedule->call(
            function () {
                CronController::courseUpdate();
            }
        )->dailyAt("00:00")->name("cursoupdate")->withoutOverlapping();
    
        $schedule->call(
            function() {
                CronController::dairyClassAlert();
            }
        )->dailyAt("00:00")->name("alertadiaria")->withoutOverlapping();

        $schedule->call(
            function() {
                CronController::updateMeetingState();
            }
        )->dailyAt("00:00")->name("updatestate")->withoutOverlapping();

        $schedule->call(
            function() {
                CronController::noClassesMessage();
            }
        )->dailyAt("10:00")->name("classmessage")->withoutOverlapping();

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
