<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Tag;

class AdminSearchService
{
    public function search($query)
    {
        $products = Product::where('name', 'like', '%' . $query . '%')->get();
        $categories = Category::where('name', 'like', '%' . $query . '%')->get();
        $subcategories = Subcategory::where('name', 'like', '%' . $query . '%')->get();
        $posts = Post::where('title', 'like', '%' . $query . '%')->get();
        $tags = Tag::where('name', 'like', '%' . $query . '%')->get();

        $hasResults = $products->isNotEmpty() || $categories->isNotEmpty() || 
                      $subcategories->isNotEmpty() || $tags->isNotEmpty() || 
                      $posts->isNotEmpty();

        return [
            'products' => $products,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'posts' => $posts,
            'tags' => $tags,
            'no_results' => !$hasResults
        ];
    }
}
