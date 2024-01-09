<?php

namespace App\Notifications;

use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SignupBonusReceived extends Notification
{
    use Queueable;

    private User $user;

    public function __construct()
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(User $notifiable): MailMessage
    {
        return (new MailMessage)
            ->from(env('MAIL_FROM_ADDRESS'), 'CezAgora')
            ->subject(sprintf('Good News for %s: Your Signup Bonus is Active Now!', $notifiable->company->name))
            ->view('vendor.notifications.signup-bonus-received', [
                'user' => $notifiable,
            ]);
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
