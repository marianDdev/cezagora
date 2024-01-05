<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomerCharged extends Notification
{
    use Queueable;

    private Order $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        //
        $this->order = $order;
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
        $message = (new MailMessage())
            ->from(env('MAIL_FROM_ADDRESS'))
            ->greeting('Hey there')
            ->subject('We have successfuly charged you')
            ->line(
                sprintf(
                    'We have successfuly charged you $%d for order #%d',
                    $this->order->total_price / 100, $this->order->id
                )
            );

        foreach ($this->order->items as $item) {
            $message->line(
                sprintf(
                    '%d x %s %s for $%d each',
                    $item->quantity,
                    $item->item_type,
                    $item->name,
                    $item->price / 100
                )
            );
        }
        $message->line(sprintf('Total $%d', $this->order->total_price / 100));
        $message->line('Thank you for using CezAgora!');

        return $message;
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
