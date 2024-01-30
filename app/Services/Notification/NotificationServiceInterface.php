<?php

namespace App\Services\Notification;

use App\Models\Notification;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Collection;

interface NotificationServiceInterface
{
    public const MEMBERSHIP_INVITATION = 'membership_invitation';

    public const CHANNEL_EMAIL = 'email';

    public const STATUS_PENDING = 'pending';
    public const STATUS_SENT = 'sent';

    public function sendWelcomeEmail(User $user): void;

    public function notifySellersAboutMoneyTransfers(Order $order): void;

    public function notifyCustomerAboutPaymentCharge(Order $order): void;

    public function notifyUsAboutUserRegistered(User $user): void;

    public function notifyUsAboutPaymentErrors(Order $order, string $error): void;

    public function createBulkNotificationsHistory(Collection $emailsChunks): void;
    public function sendMembershipInvitations(): void;
}
