<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $products = Product::where('name','like','%'.$request->search.'%')->get();
        if($products){
            return view('shop.products.index',compact('products'));
        }
    }
}
