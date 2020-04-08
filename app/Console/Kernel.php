<?php

namespace App\Console;

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
        Commands\CoordiyCommand::class,
        Commands\SpeakAICommand::class,
        Commands\SpeakMeigenCommand::class,
        Commands\ITownFgetCommand::class,
        Commands\ITownFgetUranaiCommand::class,
        Commands\ITownFgetLessonCommand::class,
        Commands\ITownFgetAllCommand::class,
        Commands\ITownFgetStudioCommand::class,
        Commands\ITownFgetHotelCommand::class,
        Commands\DeleteGoin0Command::class,
        Commands\ITownFgetITSchoolCommand::class,
        
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
