<?php

namespace App\Services\Notification;

use App\Models\Order;
use Illuminate\Support\Collection;

interface NotificationServiceInterface
{
    public function notifySellersAboutMoneyTransfers(Order $order): void;

    public function notifyCustomerAboutPaymentCharge(Order $order): void;
}
