<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Services\SearchServiceInterface;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function globalSearch(SearchRequest $request, SearchServiceInterface $service): View
    {
        $validated = $request->validated();
        $keyword = $validated['keyword'];

        if (is_null($keyword)) {
            redirect()->back();
        }

        $results = $service->globalSearch($keyword);
        /** @var Collection $companies */
        $companies = $results['companies'];
        $data = [];

        if ($companies->count() > 0) {
            $data['companies'] = $companies;
        }
        return view('search.results', $data);
    }
}
