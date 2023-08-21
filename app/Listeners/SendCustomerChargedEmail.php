<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\CustomerCharged;

class SendCustomerChargedEmail
{
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        /** @var User $user */
        $user = $event->order->customer->user;
        $user->notify(new CustomerCharged($event->order));
    }
}
