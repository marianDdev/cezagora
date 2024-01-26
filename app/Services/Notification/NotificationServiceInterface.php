<?php

namespace App\Services\Notification;

use App\Models\Order;
use App\Models\User;

interface NotificationServiceInterface
{
    public function sendWelcomeEmail(User $user): void;

    public function notifySellersAboutMoneyTransfers(Order $order): void;

    public function notifyCustomerAboutPaymentCharge(Order $order): void;

    public function notifyUsAboutUserRegistered(User $user): void;

    public function notifyUsAboutPaymentErrors(Order $order, string $error): void;

    public function sendMembershipInvitations(array $data): void;
}
