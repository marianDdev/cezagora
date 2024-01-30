<?php

namespace App\Console\Commands;

use App\Services\Notification\NotificationServiceInterface;
use Illuminate\Console\Command;

class SendMembershipInvitationsCommand extends Command
{
    private NotificationServiceInterface $notificationService;
    protected                            $signature   = 'send:membership-invitations';
    protected                            $description = 'Send membership invitation emails in batches';

    public function __construct(NotificationServiceInterface $notificationService)
    {
        parent::__construct();
        $this->notificationService = $notificationService;
    }

    public function handle()
    {
        $this->notificationService->sendMembershipInvitations();
        $this->info('Membership invitations sent.');
    }
}
