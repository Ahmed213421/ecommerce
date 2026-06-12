<?php

namespace App\Services;

use App\Repositories\Contracts\CartContract;
use App\Repositories\Contracts\OrderContract;
use App\Models\OrderDetail;
use App\Models\Setting;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CheckoutService
{
    protected $cartRepository;
    protected $orderRepository;

    public function __construct(CartContract $cartRepository, OrderContract $orderRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->orderRepository = $orderRepository;
    }

    public function getIndexData()
    {
        return [
            'cartItems' => $this->cartRepository->getUserCartItems(Auth::user()->id)
        ];
    }

    public function processCheckout($data)
    {
        $cart = $this->cartRepository->getUserCartItems(Auth::user()->id);

        $totalPrice = collect(Cart::with('product')->get())->sum(function ($item) {
            return $item->product->price_after_discount * $item->quantity;
        });
        
        $subTotal = collect(Cart::with('product')->get())->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        if ($data['payment'] == 'visa') {
            $products = Cart::with('product')->get()->map(function ($element) {
                return [
                    'price_data' => [
                        'currency' => env('CASHIER_CURRENCY', 'usd'),
                        'product_data' => [
                            'name' => $element->product->name,
                        ],
                        'unit_amount' => ceil($element->product->price_after_discount + 0.20),
                    ],
                    'quantity' => $element->quantity,
                    'adjustable_quantity' => [
                        'enabled' => true,
                        'maximum' => 100,
                        'minimum' => 0,
                    ],
                ];
            })->toArray();
            
            $cart_ids = [];
            foreach ($cart as $item) {
                $cart_ids[] = $item->id;
            }

            return Auth::user()->checkout(null, [
                'success_url' => route('customer.checkout-success', ['status' => 'success']) . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('customer.checkout-cancel', ['status' => 'cancelled']) . '?session_id={CHECKOUT_SESSION_ID}',
                'line_items' => $products,
                'metadata' => [
                    'cart_id' => implode(',', $cart_ids),
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'address' => $data['address'],
                    'phone' => $data['phone'],
                    'note' => $data['note'],
                    'totalPrice' => $totalPrice,
                    'subTotal' => $subTotal,
                ],
            ]);
        }

        if ($data['payment'] == 'cash') {
            $order = $this->orderRepository->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'address' => $data['address'],
                'phone' => $data['phone'],
                'note' => $data['note'],
                'user_id' => Auth::user()->id,
                'payment' => 'cash',
                'status' => 'pending',
                'totalprice' => $totalPrice + Setting::getTaxRate(),
                'subtotal' => $subTotal + Setting::getTaxRate(),
            ]);

            $cartproducts = $this->cartRepository->getUserCartItems(Auth::user()->id);

            foreach ($cartproducts as $cartItem) {
                $newOrderDetail = new OrderDetail();
                $newOrderDetail->product_id = $cartItem->product_id;
                $newOrderDetail->price = $cartItem->product->price_after_discount;
                $newOrderDetail->quantity = $cartItem->quantity;
                $newOrderDetail->order_id = $order->id;
                $newOrderDetail->save();
            }

            return redirect()->route('customer.home', 'requested');
        }
    }

    public function handleCheckoutSuccess($sessionId)
    {
        $session = Auth::user()->stripe()->checkout->sessions->retrieve($sessionId);
        
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

        $cartItems = $this->cartRepository->getUserCartItems(Auth::user()->id);

        if ($cartItems->isEmpty()) {
            return ['success' => false, 'message' => 'No items in cart'];
        }

        foreach ($cartItems as $cartItem) {
            $newOrderDetail = new OrderDetail();
            $newOrderDetail->product_id = $cartItem->product_id;
            $newOrderDetail->price = $cartItem->product->price_after_discount;
            $newOrderDetail->quantity = $cartItem->quantity;
            $newOrderDetail->order_id = $order->id;
            $newOrderDetail->save();

            $product = $cartItem->product;
            if ($product->quantity >= $cartItem->quantity) {
                $product->quantity -= $cartItem->quantity;
                $product->save();
            }
        }

        $user = $order->user;
        $admins = \App\Models\Admin::all();
        \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\NewOrderNotification($user));
        \App\Events\NewOrderEvent::dispatch($user);

        $this->cartRepository->clearUserCart(Auth::user()->id);

        return ['success' => true];
    }
}
