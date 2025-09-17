<?php

namespace App\Repositories\Interfaces;

interface ReviewRepositoryInterface
{
    public function create(array $data);
    public function getByProductId(int $productId, int $status = null);
    public function getByProductIdPaginated(int $productId, int $perPage = 2, int $status = null);
    public function findById(int $id);
    public function update(int $id, array $data);
    public function delete(int $id);
}
