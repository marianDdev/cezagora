<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCampaignRequest;
use App\Models\Campaign;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CampaignController extends Controller
{
    public function index(): View
    {
        return view('campaigns.index', ['campaigns' => Campaign::all()]);
    }

    public function create(): View
    {
        return view('campaigns.create');
    }

    public function store(StoreCampaignRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Campaign::create($validated);

        return redirect()->route('campaigns.index');
    }
}
