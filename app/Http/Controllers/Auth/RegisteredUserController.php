<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\Notification\NotificationServiceInterface;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Nnjeim\World\Models\Country;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $countries = Country::all();

        return view('auth.register', ['countries' => $countries]);
    }

    public function store(
        RegisterRequest $request,
        NotificationServiceInterface $notificationService
    ): RedirectResponse {
        $validated = $request->validated();
        $user = User::create($validated);

        event(new Registered($user));

        Auth::login($user);

        $notificationService->sendWelcomeEmail($user);
        $notificationService->notifyUsAboutUserRegistered($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
