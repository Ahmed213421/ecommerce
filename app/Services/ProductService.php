<?php

namespace App\Services;

use App\Repositories\Contracts\ProductContract;
use App\Repositories\Contracts\ReviewContract;

class ProductService
{
    protected $productRepository;
    protected $reviewRepository;

    public function __construct(ProductContract $productRepository, ReviewContract $reviewRepository)
    {
        $this->productRepository = $productRepository;
        $this->reviewRepository = $reviewRepository;
    }

    public function getAllProducts()
    {
        return $this->productRepository->all();
    }

    public function getProductWithReviews(string $slug, int $reviewsPerPage = 2)
    {
        $product = $this->productRepository->getWithSubcategory($slug);
        
        // $this->productRepository->incrementViews($product->id);

        $reviews = $this->reviewRepository->getByProductIdPaginated($product->id, $reviewsPerPage);

        return [
            'product' => $product,
            'reviews' => $reviews
        ];
    }
}
