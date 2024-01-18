<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MembershipInvitation extends Notification
{
    use Queueable;

    public function __construct(private readonly string $companyName)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->from(env('MAIL_FROM_ADDRESS'), 'CezAgora')
            ->subject(sprintf('Hello %s, You are invited to CezAgora B2B Cosmetics Marketplace', $this->companyName))
            ->view('vendor.notifications.membership_invitation', [
                'companyName' => $this->companyName,
            ]);
    }

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
