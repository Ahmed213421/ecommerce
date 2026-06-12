<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('shop.products.index',['products' => $this->productService->getAllProducts()]);
    }

    public function show(string $slug, Request $request)
    {
        $data = $this->productService->getProductWithReviews($slug);

        if ($request->ajax()) {
            return view('shop.products.reviews', ['reviews' => $data['reviews']])->render();
        }

        return view('shop.products.show', $data);
    }
}
