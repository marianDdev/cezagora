<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Services\Search\SearchServiceInterface;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function globalSearch(SearchRequest $request, SearchServiceInterface $service): View
    {
        $validated = $request->validated();
        $keyword = $validated['keyword'];

        if (is_null($keyword)) {
            return view('pages.home.main');
        }

        $data = $service->globalSearch($keyword);

        return view('search.results', $data);
    }
}
