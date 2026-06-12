<?php

namespace App\Services\Admin;

use App\Models\Order;

class AdminOrderService
{
    public function getAllOrders()
    {
        return Order::latest()->get();
    }
}
