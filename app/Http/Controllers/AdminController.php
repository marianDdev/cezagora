<?php

namespace App\Http\Controllers;

use App\Notifications\MembershipInvitation;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    public function showAdminPage(): View
    {
        return view('admin.index');
    }

    public function adminEmailsIndex(): View
    {
        return view('admin.emails.index');
    }

    public function previewEmail(string $emailName): View
    {
        $name = $emailName;
        $user = $this->authUser();

        return view(sprintf('vendor.notifications.%s', $name), ['user' => $user]);
    }

    public function testEmail(): View|RedirectResponse
    {
        $user = $this->authUser();

        try {
            $user->notify(new MembershipInvitation($user->company->name));
        } catch (Exception $e) {
            return view('error', ['error' => $e->getMessage()]);
        }

        return redirect()->route('dashboard');
    }
}
