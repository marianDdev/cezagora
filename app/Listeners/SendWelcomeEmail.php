<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\WelcomeEmail;
use Illuminate\Auth\Events\Registered;

class SendWelcomeEmail
{
    /**
     * Create the event listener.
     */
    public function __construct(Registered $event)
    {
        /** @var User $user */
        $user = $event->user;
        $user->notify(new WelcomeEmail($user));
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        //
    }
}
