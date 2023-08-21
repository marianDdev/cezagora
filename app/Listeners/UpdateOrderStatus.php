<?php

namespace App\Listeners;

use App\Models\Order;

class UpdateOrderStatus
{
    public function __construct()
    {
    }

    public function handle(object $event): void
    {
        $event->order->update(['status' => Order::STATUS_PAYMENT_COLLECTED]);
    }
}
