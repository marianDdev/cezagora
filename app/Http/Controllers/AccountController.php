<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class AccountController extends Controller
{
    public function showActivateAccount(): View
    {
        return view('pages.activate_account');
    }

    public function showAccountDeactivatedConfirmationPage(): View
    {
        return view('pages.account-deactivated-confirmation');
    }

    public function showAccountReactivatedConfirmationPage(): View
    {
        return view('pages.account-reactivated-confirmation');
    }
}
