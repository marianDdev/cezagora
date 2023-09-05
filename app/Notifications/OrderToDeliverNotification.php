<?php

namespace App\Notifications;

use App\Models\OrderItem;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderToDeliverNotification extends Notification
{
    use Queueable;

    private int       $daysNumber;
    private OrderItem $item;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        OrderItem $item,
        int $daysNumber,
    ) {
        $this->daysNumber = $daysNumber;
        $this->item = $item;
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
        $message = sprintf(
            'This is a reminder that in maximum %d days you have to deliver order item: %s to your client: %s, that belongs to order: #%d',
            $this->daysNumber,
            $this->item->name,
            $this->item->order->customer->name,
            $this->item->order->id
        );

        if ($this->daysNumber === 0) {
            $message = sprintf(
                'This is a reminder that today you have to deliver order item: %s to your client: %s, that belongs to order: #%d',
                $this->item->name,
                $this->item->order->customer->name,
                $this->item->order->id
            );
        }

        return (new MailMessage)
            ->from(env('MAIL_FROM_ADDRESS'))
            ->greeting(sprintf('Hi %s', $this->item->seller->name))
            ->subject('Order to deliver reminder')
            ->line($message)
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
