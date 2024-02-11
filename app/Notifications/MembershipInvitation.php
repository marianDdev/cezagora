<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Notification as Invitation;

class MembershipInvitation extends Notification
{
    use Queueable;

    public function __construct(private readonly Invitation $invitation)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $template = 'vendor.notifications.membership_invitation_for_sellers_en';

        if ($this->invitation->country === 'Romania') {
            $template = 'vendor.notifications.membership_invitation_ro';
        }

        return (new MailMessage)
            ->from(env('MAIL_FROM_ADDRESS'), 'CezAgora')
            ->subject(sprintf('Hello %s, You are invited to CezAgora B2B Cosmetics Marketplace', $this->companyName))
            ->view($template, [
                'companyName' => $this->invitation->receiver_name,
            ]);
    }

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
