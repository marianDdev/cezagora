<?php

namespace App\Console;

use App\Console\Commands\SendEmailCommand;
use App\Console\Commands\SendMembershipInvitationsCommand;
use App\Services\Notification\NotificationServiceInterface;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        SendEmailCommand::class,
        SendMembershipInvitationsCommand::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:send-email')
                 ->daily()
                 ->at('04:30')
                 ->timezone('Europe/Bucharest');

        $schedule->command('send:membership-invitations')
                 ->everyTenMinutes()
                 ->timezone('Europe/Bucharest')
                 ->when(function () {
                     return now()->hour >= NotificationServiceInterface::MEMBERSHIP_INVITATION_START_HOUR;
                 });
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
