<?php

namespace App\Repositories\Contracts;

interface ProductContract extends BaseContract
{
    public function findBySlug(string $slug);
    public function getMostViewed(int $limit = 3);
    public function getFeatured(int $limit = 3);
    public function incrementViews(int $id);
    public function getWithSubcategory(string $slug);
    public function checkStock(int $id);
}
