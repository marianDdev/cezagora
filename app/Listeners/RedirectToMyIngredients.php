<?php

namespace App\Listeners;

use Illuminate\Http\RedirectResponse;

class RedirectToMyIngredients
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): RedirectResponse
    {
        return redirect(route('my-ingredients'));
    }
}
