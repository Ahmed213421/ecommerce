<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function getAllWithSubcategoriesAndProducts()
    {
        return $this->model->with('subcategories.products')->get();
    }

    public function findBySlug(string $slug)
    {
        return $this->model->where('slug', $slug)->firstOrFail();
    }

    public function findById(int $id)
    {
        return $this->model->findOrFail($id);
    }
}
