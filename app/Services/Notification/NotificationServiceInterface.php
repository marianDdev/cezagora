<?php

namespace App\Services\Notification;

use App\Models\Order;

interface NotificationServiceInterface
{
    public function sendEmailToOrderUsers(Order $order): void;
}
