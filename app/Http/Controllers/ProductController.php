<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('shop.products.index',['products' => Product::all()]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {

        $product = Product::with('subcategory')->where('slug', $slug)->firstOrFail();

        return view('shop.products.show',compact('product'));
    }

}
