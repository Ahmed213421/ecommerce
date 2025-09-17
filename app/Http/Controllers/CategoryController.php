<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['categories'] = $this->categoryRepository->getAllWithSubcategoriesAndProducts();

        return view('shop.shop',$data);
    }



    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $category = $this->categoryRepository->findBySlug($slug);
        return view('shop.categories.show',compact('category'));
    }
}
