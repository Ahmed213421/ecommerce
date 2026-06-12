<?php

namespace App\Services;

use App\Repositories\Contracts\OrderContract;

class OrderService
{
    protected $orderRepository;

    public function __construct(OrderContract $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getUserDeliveredOrders($userId, $perPage = 5)
    {
        return $this->orderRepository->getUserOrdersPaginated($userId, 'delivered', $perPage);
    }
}
