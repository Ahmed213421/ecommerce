<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $products = Product::where('name','like','%'.$request->search.'%')->get();
        $categories = Category::where('name','like','%'.$request->search.'%')->get();
        $subcategories = Subcategory::where('name','like','%'.$request->search.'%')->get();

        if ($products->isNotEmpty() || $categories->isNotEmpty() || $subcategories->isNotEmpty()) {
            return view('shop.search.index', compact('products', 'categories', 'subcategories'))->with('no_results', false);
        }

        if ($products->isEmpty() && $categories->isEmpty() && $subcategories->isEmpty()) {
            return view('shop.search.index', compact('products', 'categories', 'subcategories'))->with('no_results', true);

        }
    }
}
