<?php

namespace App\Http\Controllers;

use App\Events\NewCustomerReviewEvent;
use App\Http\Requests\Admin\ReviewRequest;
use App\Models\Admin;
use App\Repositories\Contracts\ReviewContract;
use App\Notifications\NewCustomerReviewNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

use App\Services\ReviewService;

class ReviewController extends Controller
{
    protected $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function store(ReviewRequest $request){
        $this->reviewService->submitReview($request->validated());
        return back();
    }



}
