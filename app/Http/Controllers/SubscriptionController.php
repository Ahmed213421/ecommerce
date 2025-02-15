<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Models\Subscribers;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SubscriptionController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        Subscriber::create([
            'email' => $request->email,
        ]);

        toastr()->success(__('dashboard.subscribe_success'));
        return back();

    }

    public function unsubscribe($token)
    {

        $decryptedToken = Crypt::decrypt($token);
        $subscriber = Subscriber::where('unsubscribe_token', $decryptedToken)->first();

        if (!$subscriber) {

            return 'Invalid unsubscribe link.';
        }

        $subscriber->delete();

        return 'unsubscribed successfully';
    }


}
