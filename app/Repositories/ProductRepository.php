<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function findBySlug(string $slug)
    {
        return $this->model->where('slug', $slug)->firstOrFail();
    }

    public function findById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function getMostViewed(int $limit = 3)
    {
        return $this->model->orderBy('views', 'desc')->inRandomOrder()->limit($limit)->get();
    }

    public function getFeatured(int $limit = 3)
    {
        return $this->model->where('featured', 1)->inRandomOrder()->limit($limit)->get();
    }

    public function incrementViews(int $id)
    {
        return $this->model->where('id', $id)->increment('views');
    }

    public function getWithSubcategory(string $slug)
    {
        return $this->model->with('subcategory')->where('slug', $slug)->firstOrFail();
    }

    public function checkStock(int $id)
    {
        $product = $this->findById($id);
        return $product->quantity > 0;
    }
}
