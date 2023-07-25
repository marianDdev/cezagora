<?php

namespace App\Listeners;

use App\Notifications\WelcomeEmail;
use Illuminate\Auth\Events\Registered;

class SendWelcomeEmail
{
    /**
     * Create the event listener.
     */
    public function __construct(Registered $event)
    {
        $event->user->notify(new WelcomeEmail($event->user));
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        //
    }
}
