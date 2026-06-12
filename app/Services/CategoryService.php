<?php

namespace App\Services;

use App\Repositories\Contracts\CategoryContract;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryContract $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getShopData()
    {
        return [
            'categories' => $this->categoryRepository->getAllWithSubcategoriesAndProducts()
        ];
    }

    public function getCategoryBySlug(string $slug)
    {
        return $this->categoryRepository->findBySlug($slug);
    }
}
