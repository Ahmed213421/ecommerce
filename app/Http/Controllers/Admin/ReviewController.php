<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    protected $adminReviewService;

    public function __construct(AdminReviewService $adminReviewService)
    {
        $this->adminReviewService = $adminReviewService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = $this->adminReviewService->getAllReviews();
        return view('dashboard.review.index', compact('reviews'));
    }
}
