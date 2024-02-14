<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(): View
    {
        return view('pages.contact');
    }

    public function adminIndex(): View
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.contact_messages.index', ['messages' => $messages]);
    }

    public function showMessageSent(): \Illuminate\Contracts\View\View
    {
        return view('pages.contact-message-sent');
    }

    public function store(StoreContactMessageRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        ContactMessage::create($validated);

        return redirect()->route('contact.message.sent');
    }
}
