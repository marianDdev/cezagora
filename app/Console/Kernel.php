<?php

namespace App\Console;

use App\Console\Commands\AddCountryCodeAndContinentCommand;
use App\Console\Commands\UpdateAllIngredientsCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        AddCountryCodeAndContinentCommand::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:send-email')
            ->daily()
            ->at('21:08')
            ->timezone('Europe/Bucharest');
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
