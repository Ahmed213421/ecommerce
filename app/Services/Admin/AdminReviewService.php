<?php

namespace App\Services\Admin;

use App\Models\Review;

class AdminReviewService
{
    public function getAllReviews()
    {
        return Review::all();
    }
}
