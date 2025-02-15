<?php

namespace App\Http\Controllers;

use App\Events\NewCustomerReviewEvent;
use App\Models\Admin;
use App\Models\Review;
use App\Notifications\NewCustomerReviewNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('shop.review');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'phone' => 'required',
            'email' => 'email|required',
            'subject' => 'required|max:100',
            'message' => 'required',
        ]);
        if ($validator->fails()) {
            // Redirect back to the form with the error messages
            return back()
            ->withErrors($validator)
            ->withInput();
        };

        $customer = Review::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 0,
        ]);

        $admins = Admin::all();
        Notification::send($admins,new NewCustomerReviewNotification($customer));

        NewCustomerReviewEvent::dispatch($customer);

        return back()->with('success','your message hass sent please wait for verification');
    }

}
