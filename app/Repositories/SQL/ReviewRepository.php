<?php

namespace App\Repositories\SQL;

use App\Models\Review;
use App\Repositories\Contracts\ReviewContract;

class ReviewRepository extends BaseRepository implements ReviewContract
{
    public function __construct(Review $model)
    {
        parent::__construct($model);
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

    public function updateById(int $id, array $data)
    {
        $review = $this->findOrFail($id);
        return $this->update($review, $data);
    }

    public function deleteById(int $id)
    {
        $review = $this->findOrFail($id);
        return $this->remove($review);
    }
}
