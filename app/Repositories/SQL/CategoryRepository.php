<?php

namespace App\Repositories\SQL;

use App\Models\Category;
use App\Repositories\Contracts\CategoryContract;

class CategoryRepository extends BaseRepository implements CategoryContract
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
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
