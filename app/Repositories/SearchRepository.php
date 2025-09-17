<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Repositories\Interfaces\SearchRepositoryInterface;

class SearchRepository implements SearchRepositoryInterface
{
    public function searchProducts(string $query)
    {
        return Product::where('name', 'like', '%' . $query . '%')->get();
    }

    public function searchCategories(string $query)
    {
        return Category::where('name', 'like', '%' . $query . '%')->get();
    }

    public function searchSubcategories(string $query)
    {
        return Subcategory::where('name', 'like', '%' . $query . '%')->get();
    }

    public function searchAll(string $query)
    {
        return [
            'products' => $this->searchProducts($query),
            'categories' => $this->searchCategories($query),
            'subcategories' => $this->searchSubcategories($query),
        ];
    }
}
