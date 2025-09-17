<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\Review;

interface TestmonialRepositoryInterface
{
    /**
     * Create a new review
     *
     * @param array $data
     * @return Review
     */
    public function create(array $data);
}
