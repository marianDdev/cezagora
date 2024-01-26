<?php

namespace App\Http\Controllers;

use App\Http\Requests\MembershipInvitationRequest;
use App\Imports\InvitationImport;
use App\Models\Notification;
use App\Services\Notification\NotificationServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class NotificationController extends Controller
{
    public function createMembershipInvitation(): View
    {
        $invitations = Notification::orderBy('created_at', 'desc')->paginate(50);

        return view(
            'admin.emails.membership_invitation',
            ['invitations' => $invitations]
        );
    }

    public function storeMembershipInvitation(
        NotificationServiceInterface $service
    ): RedirectResponse
    {
        $import = new InvitationImport();
        Excel::import($import, request()->file('invitation'));

        $chunks = $import->getEmails()->chunk(50);

        foreach ($chunks as $chunk) {
            foreach ($chunk as $emailData) {
                if (is_null($emailData['email'])) {
                    continue;
                }

                $existingNotification = Notification::where(
                    [
                        'name' => 'membership_invitation',
                        'receiver_email' => $emailData['email'],
                    ]
                )->first();

                if (!is_null($existingNotification)) {
                    continue;
                }

                $service->sendMembershipInvitations($emailData);
            }
        }

        return redirect()->route('membership_invitation.create');
    }
}
