<?php

namespace App\Services\Notification;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Notifications\CustomerCharged;
use App\Notifications\OrderProcessed;
use Illuminate\Support\Collection;

class NotificationService implements NotificationServiceInterface
{
    public function notifySellersAboutMoneyTransfers(Order $order): void
    {
        //todo create proper notificatiosn and attach invoices

        $items = $order->items->groupBy('seller')->map(fn($item) => $item->sum('total'));

        foreach ($items as $seller => $total) {
            //todo apply fee declara apply fee as static and call it here
            $sellerData = json_decode($seller, true);
            $sellerUser = User::find($sellerData['user']['id']);
            $sellerName = $sellerData['name'];
            $customerName = $order->customer->name;

            $sellerUser->notify(new OrderProcessed($total, $customerName, $sellerName));
        }
    }

    public function notifyCustomerAboutPaymentCharge(Order $order): void
    {
        $customerUser = $order->customer->user;

        $customerUser->notify(new CustomerCharged($order));
    }
}
