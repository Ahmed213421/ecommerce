<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Tag;
use Illuminate\Http\Request;

class SearhController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $products = Product::where('name','like','%'.$request->search.'%')->get();
        $categories = Category::where('name','like','%'.$request->search.'%')->get();
        $subcategories = Subcategory::where('name','like','%'.$request->search.'%')->get();
        $posts = Post::where('title','like','%'.$request->search.'%')->get();
        $tags = Tag::where('name','like','%'.$request->search.'%')->get();

        if ($products->isNotEmpty()
         || $categories->isNotEmpty()
         || $subcategories->isNotEmpty()
         || $tags->isNotEmpty()
         || $posts->isNotEmpty() ) {
            return view('dashboard.search.index', compact('products', 'categories', 'subcategories','posts','tags'))->with('no_results', false);
        }

        if ($products->isEmpty() && $categories->isEmpty() && $subcategories->isEmpty()
            && $tags->isEmpty() && $posts->isEmpty()) {
            return view('dashboard.search.index', compact('products', 'categories', 'subcategories','posts','tags'))->with('no_results', true);

        }

    }
}
