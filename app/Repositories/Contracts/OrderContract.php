<?php

namespace App\Repositories\Contracts;

interface OrderContract
{
    public function getUserOrders(int $userId, string $status = null);
    public function getUserOrdersPaginated(int $userId, string $status = null, int $perPage = 5);
    public function findById(int $id);
    public function create(array $data);
    public function updateById(int $id, array $data);
    public function deleteById(int $id);
}
