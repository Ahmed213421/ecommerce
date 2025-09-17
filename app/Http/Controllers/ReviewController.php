<?php

namespace App\Http\Controllers;

use App\Events\NewCustomerReviewEvent;
use App\Http\Requests\Admin\ReviewRequest;
use App\Models\Admin;
use App\Repositories\Interfaces\ReviewRepositoryInterface;
use App\Notifications\NewCustomerReviewNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ReviewController extends Controller
{
    protected $reviewRepository;

    public function __construct(ReviewRepositoryInterface $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function store(ReviewRequest $request){
        
        if(Auth::check()){
            $hasPurchased = auth()->user()->purchasedProducts()->where('products.id', $request->product_id)->exists();


            if (! $hasPurchased) {
                toastr()->error('You can only review products you have purchased.');
                return back();
            }
            $review = $this->reviewRepository->create([
                'name' => request('name'),
                'phone' => request('phone'),
                'email' => request('email'),
                'subject' => request('subject'),
                'message' => request('message'),
                'status' => 0,
                'product_id' => request('product_id'),
            ]);



            $admins = Admin::all();
            Notification::send($admins, new NewCustomerReviewNotification($review));
            NewCustomerReviewEvent::dispatch($review);

            toastr()->success('Your message has been sent, please wait for verification');
        } else {
            toastr()->error('You must be logged in to submit a review.');
            return back();
        }
        return back();
    }



}
