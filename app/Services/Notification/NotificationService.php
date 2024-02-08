<?php

namespace App\Services\Notification;

use App\Models\Notification;
use App\Models\Notification as NotificationsHistory;
use App\Models\Order;
use App\Models\User;
use App\Notifications\CustomerCharged;
use App\Notifications\MembershipInvitation;
use App\Notifications\OrderProcessed;
use App\Notifications\WelcomeEmail;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Collection;
use Spatie\SlackAlerts\SlackAlert;
use Symfony\Component\Mailer\Exception\TransportException;

class NotificationService implements NotificationServiceInterface
{
    private SlackAlert $slackAlert;

    public function __construct(SlackAlert $slackAlert)
    {
        $this->slackAlert = $slackAlert;
    }

    public function sendWelcomeEmail(User $user): void
    {
        $user->notify(new WelcomeEmail($user));
    }

    public function notifySellersAboutMoneyTransfers(Order $order): void
    {
        //todo create proper notificatiosn and attach invoices

        $items = $order->items->groupBy('seller')->map(fn($item) => $item->sum('total'));

        foreach ($items as $seller => $total) {
            //todo apply fee declara apply fee as static and call it here
            $sellerData   = json_decode($seller, true);
            $sellerUser   = User::find($sellerData['user']['id']);
            $sellerName   = $sellerData['name'];
            $customerName = $order->customer->name;

            $sellerUser->notify(new OrderProcessed($total, $customerName, $sellerName));
        }
    }

    public function notifyCustomerAboutPaymentCharge(Order $order): void
    {
        $customerUser = $order->customer->user;

        $customerUser->notify(new CustomerCharged($order));
    }

    public function notifyUsAboutUserRegistered(User $user): void
    {
        $this->slackAlert->blocks(
            [
                [
                    "type" => "section",
                    "text" => [
                        "type" => "mrkdwn",
                        "text" => "We have a new registered user!",
                    ],
                ],
                [
                    "type" => "section",
                    "text" => [
                        "type" => "mrkdwn",
                        "text" => sprintf('ID: #%d', $user->id),
                    ],
                ],
                [
                    "type" => "section",
                    "text" => [
                        "type" => "mrkdwn",
                        "text" => sprintf('Name: %s', $user->fullName),
                    ],
                ],
                [
                    "type" => "section",
                    "text" => [
                        "type" => "mrkdwn",
                        "text" => sprintf('Email: %s', $user->email),
                    ],
                ],
            ]
        );
    }

    public function notifyUsAboutPaymentErrors(Order $order, string $error): void
    {
        $this->slackAlert->to('payment-errors')->blocks(
            [
                [
                    "type" => "section",
                    "text" => [
                        "type" => "mrkdwn",
                        "text" => sprintf("Unable to create payment intent for order #%s", $order->id),
                    ],
                ],
                [
                    "type" => "section",
                    "text" => [
                        "type" => "mrkdwn",
                        "text" => sprintf('Buyer: %s', $order->customer->name),
                    ],
                ],
                [
                    "type" => "section",
                    "text" => [
                        "type" => "mrkdwn",
                        "text" => sprintf('Error message: %s', $error),
                    ],
                ],
            ]
        );
    }

    public function createBulkNotificationsHistory(Collection $emailsChunks): void
    {
        foreach ($emailsChunks as $chunk) {
            foreach ($chunk as $emailData) {
                if (is_null($emailData['email'])) {
                    continue;
                }

                $existingNotification = Notification::where(
                    [
                        'name'           => self::MEMBERSHIP_INVITATION,
                        'receiver_email' => $emailData['email'],
                    ]
                )->first();

                if (!is_null($existingNotification)) {
                    continue;
                }

                $this->createNotificationHistory($emailData);
            }
        }
    }

    public function sendMembershipInvitations(): void
    {
        Notification::where(
            [
                'name'    => self::MEMBERSHIP_INVITATION,
                'channel' => self::CHANNEL_EMAIL,
                'status'  => self::STATUS_PENDING,
            ]
        )->chunk(self::MEMBERSHIP_INVITATION_BATCH_LIMIT, function ($unsentInvitations) {
            foreach ($unsentInvitations as $invitation) {
                $notifiable = new AnonymousNotifiable;
                $notifiable->route('mail', $invitation->receiver_email);

                try {
                    $notifiable->notify(new MembershipInvitation($invitation->receiver_name));
                } catch (TransportException $e) {
                    continue;
                }

                $invitation->update(['status' => self::STATUS_SENT]);
            }
        });
    }

    private function createNotificationHistory(array $data): void
    {
        NotificationsHistory::create(
            [
                'company_id'     => null,
                'name'           => self::MEMBERSHIP_INVITATION,
                'channel'        => 'email',
                'receiver_name'  => $data['name'],
                'receiver_email' => $data['email'],
                'country'        => $data['country'] ?? null,
                'phone'          => $data['phone'] ?? null,
                'status'         => self::STATUS_PENDING,
            ]
        );
    }
}
