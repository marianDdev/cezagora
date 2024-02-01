<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Search;
use App\Services\Search\SearchServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index(): View
    {
        //searched keywords with no results
        $searches    = Search::orderBy('count', 'desc')->paginate(50);
        $topKeywords = Search::query()
                             ->select('keyword', \Illuminate\Support\Facades\DB::raw('SUM(count) as total_count'))
                             ->groupBy('keyword')
                             ->orderBy('total_count', 'desc')
                             ->take(10)
                             ->get();

        return view(
            'admin.search.index',
            [
                'searches'    => $searches,
                'topKeywords' => $topKeywords,
            ]
        );
    }

    public function globalSearch(SearchRequest $request, SearchServiceInterface $service): RedirectResponse
    {
        $validated = $request->validated();
        $keyword   = $validated['keyword'];

        if (is_null($keyword)) {
            return redirect()->back();
        }

        return redirect()->route('search.results', ['keyword' => $keyword]);
    }

    public function showResults(Request $request, SearchServiceInterface $service): View
    {
        $company              = $this->authUserCompany();
        $keyword              = $request->query('keyword');
        $data = $service->globalSearch($keyword);


        if (!isset($data['ingredients']) && !isset($data['companies'])) {
            $service->create($keyword, $company);
        }

        return view('search.results', $data);
    }
}
