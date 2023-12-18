<?php

namespace App\Http\Controllers;

use App\Http\Requests\SwitchLanguageRequest;
use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller
{
    public function switchLanguage(SwitchLanguageRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $language  = $validated['language'];

        session(['language' => $language]);

        return redirect()->back()->with(['language_switched' => $language]);
    }
}
