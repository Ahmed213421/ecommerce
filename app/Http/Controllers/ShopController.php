<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $data['categories'] = Category::with('subcategories.products')->get();

        return view('shop.shop',$data);
    }
}
