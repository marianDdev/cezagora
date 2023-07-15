<?php

namespace App\Services\Notification;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Notifications\OrderProcessed;

class NotificationService implements NotificationServiceInterface
{
    public function sendEmailToOrderUsers(Order $order): void
    {
        //todo create proper notificatiosn and attach invoices
        //$order->customer->user->notify(new OrderProcessed());

        $customerName = $order->customer->name;

        $orderItems = $order->items->groupBy('seller')->map(fn($item) => $item->sum('total'));

        foreach ($orderItems as $seller => $total) {
            //todo apply fee declara apply fee as static and call it here
            $sellerData = json_decode($seller, true);
            $sellerUser = User::find($sellerData['user']['id']);
            $sellerName = $sellerData['name'];

            $sellerUser->notify(new OrderProcessed($total, $customerName, $sellerName));
        }
    }
}
