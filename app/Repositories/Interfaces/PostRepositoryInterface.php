<?php

namespace App\Repositories\Interfaces;

interface PostRepositoryInterface
{
    public function getLatestPaginated(int $perPage = 12);
    public function findBySlug(string $slug);
    public function getLatest(int $limit = 5);
    public function getLatestWithLimit(int $limit = 3);
}
