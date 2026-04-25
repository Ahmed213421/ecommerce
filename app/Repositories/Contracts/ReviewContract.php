<?php

namespace App\Repositories\Contracts;

interface ReviewContract
{
    public function create(array $data);
    public function getByProductId(int $productId, int $status = null);
    public function getByProductIdPaginated(int $productId, int $perPage = 2, int $status = null);
    public function findById(int $id);
    public function updateById(int $id, array $data);
    public function deleteById(int $id);
}
