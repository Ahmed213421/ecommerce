<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    protected $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function getUserOrders(int $userId, string $status = null)
    {
        $query = $this->model->where('user_id', $userId);
        
        if ($status) {
            $query->where('status', $status);
        }
        
        return $query->get();
    }

    public function getUserOrdersPaginated(int $userId, string $status = null, int $perPage = 5)
    {
        $query = $this->model->where('user_id', $userId);
        
        if ($status) {
            $query->where('status', $status);
        }
        
        return $query->paginate($perPage);
    }

    public function findById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $order = $this->findById($id);
        $order->update($data);
        return $order;
    }

    public function delete(int $id)
    {
        $order = $this->findById($id);
        return $order->delete();
    }
}
