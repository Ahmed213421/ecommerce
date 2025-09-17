<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function all();
    public function findBySlug(string $slug);
    public function findById(int $id);
    public function getMostViewed(int $limit = 3);
    public function getFeatured(int $limit = 3);
    public function incrementViews(int $id);
    public function getWithSubcategory(string $slug);
    public function checkStock(int $id);
}
