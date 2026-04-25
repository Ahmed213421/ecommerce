<?php

namespace App\Repositories\Contracts;

interface OrderContract extends BaseContract
{
    public function getUserOrders(int $userId, string $status = null);
    public function getUserOrdersPaginated(int $userId, string $status = null, int $perPage = 5);
}
