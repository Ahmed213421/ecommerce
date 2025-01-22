<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutSuccessController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,$status)
    {
        $orderId = Session::get('orderid');
            Order::find($orderId)->update(['status' => 'delivered']);
            // App\Models\Cart::where('user_id',auth()->user()->id)->delete();
            Session::forget('orderid');
            return view('welcome');
    }
}
