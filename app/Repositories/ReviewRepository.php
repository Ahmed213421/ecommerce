<?php

namespace App\Repositories;

use App\Models\Review;
use App\Repositories\Interfaces\ReviewRepositoryInterface;

class ReviewRepository implements ReviewRepositoryInterface
{
    protected $model;

    public function __construct(Review $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function getByProductId(int $productId, int $status = null)
    {
        $query = $this->model->where('product_id', $productId);
        
        if ($status !== null) {
            $query->where('status', $status);
        }
        
        return $query->get();
    }

    public function getByProductIdPaginated(int $productId, int $perPage = 2, int $status = null)
    {
        $query = $this->model->where('product_id', $productId);
        
        if ($status !== null) {
            $query->where('status', $status);
        }
        
        return $query->paginate($perPage);
    }

    public function findById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        $review = $this->findById($id);
        $review->update($data);
        return $review;
    }

    public function delete(int $id)
    {
        $review = $this->findById($id);
        return $review->delete();
    }
}
