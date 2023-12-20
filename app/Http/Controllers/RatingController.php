<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRatingRequest;
use App\Models\Company;
use App\Models\Rating;
use Illuminate\Http\RedirectResponse;

class RatingController extends Controller
{
    public function index(int $companyId)
    {
        $company = Company::find($companyId);
        $ratings = $company->receivedRatings;

        return view('ratings.index', ['ratings' => $ratings]);
    }

    public function submitRating(StoreRatingRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Rating::create($validated);

        return back()->with('success', 'Rating submitted successfully.');
    }
}
