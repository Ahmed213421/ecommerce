<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\SearchRepositoryInterface;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected $searchRepository;

    public function __construct(SearchRepositoryInterface $searchRepository)
    {
        $this->searchRepository = $searchRepository;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $results = $this->searchRepository->searchAll($request->search);
        
        $products = $results['products'];
        $categories = $results['categories'];
        $subcategories = $results['subcategories'];

        if ($products->isNotEmpty() || $categories->isNotEmpty() || $subcategories->isNotEmpty()) {
            return view('shop.search.index', compact('products', 'categories', 'subcategories'))->with('no_results', false);
        }

        if ($products->isEmpty() && $categories->isEmpty() && $subcategories->isEmpty()) {
            return view('shop.search.index', compact('products', 'categories', 'subcategories'))->with('no_results', true);
        }
    }
}
