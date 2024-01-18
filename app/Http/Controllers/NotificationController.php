<?php

namespace App\Http\Controllers;

use App\Http\Requests\MembershipInvitationRequest;
use App\Models\Notification;
use App\Services\Notification\NotificationServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class NotificationController extends Controller
{
    public function createMembershipInvitation(): View
    {
        $invitations = Notification::orderBy('created_at', 'desc')->paginate(10);
        return view(
            'admin.emails.membership_invitation',
            ['invitations' => $invitations]
        );
    }

    public function storeMembershipInvitation(
        MembershipInvitationRequest  $request,
        NotificationServiceInterface $service
    ): RedirectResponse
    {
        $validated = $request->validated();
        $service->sendMembershipInvitations($validated);

        return redirect()->route('membership_invitation.create');
    }
}
