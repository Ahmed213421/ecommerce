<?php

namespace App\Repositories\Interfaces;

interface OrderRepositoryInterface
{
    public function getUserOrders(int $userId, string $status = null);
    public function getUserOrdersPaginated(int $userId, string $status = null, int $perPage = 5);
    public function findById(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}
