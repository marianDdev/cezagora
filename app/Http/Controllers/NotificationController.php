<?php

namespace App\Http\Controllers;

use App\Imports\InvitationImport;
use App\Models\Notification;
use App\Services\Notification\NotificationServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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
        $emailsChunks = $import->getEmails()->chunk(50);
        $service->createBulkNotificationsHistory($emailsChunks);

        return redirect()->route('membership_invitation.create');
    }
}
