<?php

namespace App\Http\Controllers;

use App\Events\NewOrderEvent;
use App\Models\Admin;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Notifications\NewOrderNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class CheckoutSuccessController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,$status)
    {

        try {
            DB::beginTransaction();

        $session = $request->user()->stripe()->checkout->sessions->retrieve($request->get('session_id'));
        $cart_ids = explode(',',$session->metadata->cart_id);
        $cart = Cart::whereIn('id',$cart_ids)->get();

        $order = new Order();
        $order->name = $session->metadata->name;
        $order->email = $session->metadata->email;
        $order->address = $session->metadata->address;
        $order->phone = $session->metadata->phone;
        $order->note = $session->metadata->note;
        $order->user_id = Auth::user()->id;
        $order->payment = 'visa';
        $order->status = 'delivered';
        $order->totalprice = ceil($session->metadata->totalPrice + 0.20);
        $order->subtotal = ceil($session->metadata->subTotal + 0.20);
        $order->save();

        $cartproducts = Cart::where('user_id',Auth::user()->id)->get();

        foreach($cartproducts as $cart){
            $newOrderDetail = new OrderDetail();
            $newOrderDetail->product_id = $cart->product_id;
            $newOrderDetail->price = $cart->product->price_after_discount;
            $newOrderDetail->quantity = $cart->quantity;
            $newOrderDetail->order_id = $order->id;
            $newOrderDetail->save();
        }

        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'No items in cart'], 400);
        }

        foreach ($cartItems as $cartItem) {
            $product = $cartItem->product;


            if ($product->quantity >= $cartItem->quantity) {
                $product->quantity -= $cartItem->quantity;
                $product->save();
            }
        }

        $user = $order->user;
        $admins = Admin::all();
        Notification::send($admins,new NewOrderNotification($user));

        NewOrderEvent::dispatch($user);

        Cart::where('user_id',auth()->user()->id)->delete();
        DB::commit();
        toastr()->success('تم الدفع');


        return view('welcome');
    } catch (Exception $e) {
        DB::rollBack(); 

	    Log::error('Cart update failed: ' . $e->getMessage(), [
            'exception' => $e
        ]);

        return back()->withErrors(['error' => 'Something went wrong, please try again later.']);

         }



    }
}
