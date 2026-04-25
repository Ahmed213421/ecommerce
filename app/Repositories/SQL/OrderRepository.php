<?php

namespace App\Repositories\SQL;

use App\Models\Order;
use App\Repositories\Contracts\OrderContract;

class OrderRepository extends BaseRepository implements OrderContract
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
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

    public function updateById(int $id, array $data)
    {
        $order = $this->findById($id);
        $order->update($data);
        return $order;
    }

    public function deleteById(int $id)
    {
        $order = $this->findById($id);
        return $order->delete();
    }
}
