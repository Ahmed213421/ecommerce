<?php

namespace App\Http\Controllers;

use App\Services\SearchService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data = $this->searchService->search($request->query('search', ''));
        
        return view('shop.search.index', [
            'products' => $data['products'],
            'categories' => $data['categories'],
            'subcategories' => $data['subcategories']
        ])->with('no_results', $data['no_results']);
    }
}
