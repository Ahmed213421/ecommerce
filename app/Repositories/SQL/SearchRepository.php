<?php

namespace App\Repositories\SQL;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Repositories\Contracts\SearchContract;

class SearchRepository implements SearchContract
{
    public function searchProducts(string $query)
    {
        return Product::where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->get();
    }

    public function searchCategories(string $query)
    {
        return Category::where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->get();
    }

    public function searchSubcategories(string $query)
    {
        return Subcategory::where('name', 'like', "%{$query}%")
            ->get();
    }

    public function searchAll(string $query)
    {
        if (empty(trim($query))) {
            return [
                'products' => collect(),
                'categories' => collect(),
                'subcategories' => collect(),
            ];
        }

        return [
            'products' => $this->searchProducts($query),
            'categories' => $this->searchCategories($query),
            'subcategories' => $this->searchSubcategories($query),
        ];
    }
}
