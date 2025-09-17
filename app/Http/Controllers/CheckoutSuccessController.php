<?php

namespace App\Http\Controllers;

use App\Events\NewOrderEvent;
use App\Models\Admin;
use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
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
    protected $cartRepository;
    protected $orderRepository;

    public function __construct(CartRepositoryInterface $cartRepository, OrderRepositoryInterface $orderRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,$status)
    {

        try {
            DB::beginTransaction();

        $session = $request->user()->stripe()->checkout->sessions->retrieve($request->get('session_id'));
        $cart_ids = explode(',',$session->metadata->cart_id);
        // Note: We'll need to add a method to get cart items by IDs in the repository
        $cart = $this->cartRepository->getUserCartItems(Auth::user()->id);

        $order = $this->orderRepository->create([
            'name' => $session->metadata->name,
            'email' => $session->metadata->email,
            'address' => $session->metadata->address,
            'phone' => $session->metadata->phone,
            'note' => $session->metadata->note,
            'user_id' => Auth::user()->id,
            'payment' => 'visa',
            'status' => 'delivered',
            'totalprice' => ceil($session->metadata->totalPrice + 0.20),
            'subtotal' => ceil($session->metadata->subTotal + 0.20),
        ]);

        $cartproducts = $this->cartRepository->getUserCartItems(Auth::user()->id);

        foreach($cartproducts as $cart){
            $newOrderDetail = new OrderDetail();
            $newOrderDetail->product_id = $cart->product_id;
            $newOrderDetail->price = $cart->product->price_after_discount;
            $newOrderDetail->quantity = $cart->quantity;
            $newOrderDetail->order_id = $order->id;
            $newOrderDetail->save();
        }

        $cartItems = $this->cartRepository->getUserCartItems(auth()->id());

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

        $this->cartRepository->clearUserCart(auth()->user()->id);
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
