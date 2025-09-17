<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\ReviewRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;
    protected $reviewRepository;

    public function __construct(ProductRepositoryInterface $productRepository, ReviewRepositoryInterface $reviewRepository)
    {
        $this->productRepository = $productRepository;
        $this->reviewRepository = $reviewRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('shop.products.index',['products' => $this->productRepository->all()]);
    }


    /**
     * Display the specified resource.
     */
//     public function show(string $slug)
// {
//     $product = Product::with('subcategory')->where('slug', $slug)->firstOrFail();
//     $product->increment('views');

//     $reviews = Review::where('status', 1)
//         ->where('product_id', $product->id)
//         ->paginate(1);

//     if (request()->ajax()) {
//         return view('partials.reviews', compact('reviews'))->render();
//     }

//     return view('shop.products.show', compact('product', 'reviews'));
// }

public function show(string $slug,Request $request)
{
    $product = $this->productRepository->getWithSubcategory($slug);
    $reviews = $this->reviewRepository->getByProductIdPaginated($product->id, 2);

    if ($request->ajax()) {
        return view('shop.products.reviews', compact('reviews'))->render();
    }

    return view('shop.products.show', compact('product', 'reviews'));
}


}
