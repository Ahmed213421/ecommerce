<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        return view('shop.subcategory.show',['subcategory' => Subcategory::where('slug',$slug)->firstOrFail()]);
    }
}
