<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRatingRequest;
use App\Models\Company;
use App\Models\Rating;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RatingController extends Controller
{
    public function index(string $slug): View
    {
        $company = Company::where('slug', $slug)->first();
        $averageRating = $company->receivedRatings->count() > 0 ? round($company->receivedRatings()->avg('rating')) : 0;

        return view('ratings.index', ['company' => $company, 'averageRating' => $averageRating]);
    }

    public function submitRating(StoreRatingRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Rating::create($validated);

        return back()->with('success', 'Rating submitted successfully.');
    }
}
