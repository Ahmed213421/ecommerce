<?php

namespace App\Services;

use App\Repositories\Contracts\SearchContract;

class SearchService
{
    protected $searchRepository;

    public function __construct(SearchContract $searchRepository)
    {
        $this->searchRepository = $searchRepository;
    }

    public function search(string $query)
    {
        $results = $this->searchRepository->searchAll($query);
        
        $products = $results['products'];
        $categories = $results['categories'];
        $subcategories = $results['subcategories'];

        $no_results = $products->isEmpty() && $categories->isEmpty() && $subcategories->isEmpty();

        return compact('products', 'categories', 'subcategories', 'no_results');
    }
}
