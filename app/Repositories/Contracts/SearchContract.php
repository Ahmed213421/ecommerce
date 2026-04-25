<?php

namespace App\Repositories\Contracts;

interface SearchContract
{
    public function searchProducts(string $query);
    public function searchCategories(string $query);
    public function searchSubcategories(string $query);
    public function searchAll(string $query);
}
