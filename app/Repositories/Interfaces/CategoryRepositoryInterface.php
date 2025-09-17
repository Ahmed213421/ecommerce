<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface
{
    public function all();
    public function getAllWithSubcategoriesAndProducts();
    public function findBySlug(string $slug);
    public function findById(int $id);
}
