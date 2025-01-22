<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['categories'] = Category::all();
        return view('shop.shop',$data);
    }



    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $category = Category::where('slug',$slug)->firstOrFail();
        return view('shop.categories.show',compact('category'));
    }
}
