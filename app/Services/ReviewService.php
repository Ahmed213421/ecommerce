<?php

namespace App\Services;

use App\Events\NewCustomerReviewEvent;
use App\Models\Admin;
use App\Repositories\Contracts\ReviewContract;
use App\Notifications\NewCustomerReviewNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ReviewService
{
    protected $reviewRepository;

    public function __construct(ReviewContract $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function submitReview(array $data)
    {
        if (Auth::check()) {
            $hasPurchased = Auth::user()->purchasedProducts()->where('products.id', $data['product_id'])->exists();

            if (!$hasPurchased) {
                toastr()->error('You can only review products you have purchased.');
                return false;
            }

            $review = $this->reviewRepository->create([
                'name' => $data['name'] ?? request('name'),
                'phone' => $data['phone'] ?? request('phone'),
                'email' => $data['email'] ?? request('email'),
                'subject' => $data['subject'] ?? request('subject'),
                'message' => $data['message'] ?? request('message'),
                'status' => 0,
                'product_id' => $data['product_id'] ?? request('product_id'),
            ]);

            $admins = Admin::all();
            Notification::send($admins, new NewCustomerReviewNotification($review));
            NewCustomerReviewEvent::dispatch($review);

            toastr()->success('Your message has been sent, please wait for verification');
            return true;
        } else {
            toastr()->error('You must be logged in to submit a review.');
            return false;
        }
    }
}
