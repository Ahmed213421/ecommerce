<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->categoryService->getShopData();

        return view('shop.shop',$data);
    }



    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $category = $this->categoryService->getCategoryBySlug($slug);
        return view('shop.categories.show',compact('category'));
    }
}
