<?php

namespace App\Repositories\Contracts;

interface ReviewContract extends BaseContract
{
    public function getByProductId(int $productId, int $status = null);
    public function getByProductIdPaginated(int $productId, int $perPage = 2, int $status = null);
}
