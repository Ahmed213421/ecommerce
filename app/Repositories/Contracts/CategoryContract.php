<?php

namespace App\Repositories\Contracts;

interface CategoryContract extends BaseContract
{
    public function getAllWithSubcategoriesAndProducts();
    public function findBySlug(string $slug);
    public function findById(int $id);
}
