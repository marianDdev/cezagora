<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderProcessed extends Notification
{
    use Queueable;

    private int    $amount;
    private string $customer;
    private string $seller;

    /**
     * Create a new notification instance.
     */
    public function __construct(int $amount, string $customer, string $seller)
    {
        $this->amount = $amount;
        $this->customer = $customer;
        $this->seller = $seller;
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

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->from(env('MAIL_FROM_ADDRESS'))
            ->greeting(sprintf('Hi %s', $this->seller))
            ->subject('your order is processed')
            ->line(sprintf('You have received %d from CezAgora on behalf of %s', $this->amount, $this->customer))
            ->line('Thank you for using CezAgora!');
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
