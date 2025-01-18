<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Laravel\Cashier\Checkout;

class CheckOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['cartItems'] = Cart::with('product')->where('user_id',Auth::user()->id)->get();


        $cart = Cart::with('product')
        ->where('user_id', Auth::user()->id)
        ->first();



        return view('shop.cart.checkout',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cart = Cart::with('product')
        ->where('user_id', Auth::user()->id)
        ->get();


        $prices = [];

foreach ($cart as $item) {
    if ($item->product) {
        $prices[$item->product->stripe_price_id] = $item->quantity;
    }
}
// return $prices;

        // dd(Auth::user()->checkout($prices));

        $validator = Validator::make($request->all(),[
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'address' => 'required|string|max:255',
        'phone' => 'required|numeric|digits_between:7,15',
        'note' => 'nullable|string|max:1000',
        'payment' => 'required|in:visa,cash',
        ]);


        if ($validator->fails()) {
            // Redirect back to the form with the error messages
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        if (Auth::check()) {
            // return $request->payment;
            if($request->payment == 'visa'){

                $order = new Order();
                $order->name = $request->name;
                $order->email = $request->email;
                $order->address = $request->address;
                $order->phone = $request->phone;
                $order->note = $request->note;
                $order->user_id = Auth::user()->id;
                $order->payment = 'visa';
                $order->status = 'delivered';
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

                // $totalPrice = collect(Cart::with('product')->get())->sum(function ($item) {
                //     return $item->product->price_after_discount * $item->quantity;
                // });



                // return $payment = Auth::user()->checkout(['price_1QgqWY4ROQ2T8rH2mClSz5sw' => 2],[
                    //     'success_url' => route('customer.checkout-success',['session_id' => 's']),
                    // ]);
                    $sessionOrderId = Session::put('orderid',$order->id);
                    $products = $cart::with('product')->get()->map(function($element){

                        return [
                            'price_data' => [

                                'currency' => env('CASHIER_CURRENCY' , 'usd'),
                                'product_data' => [
                                    'name' => $element->product->name,
                                ],
                                'unit_amount' => $element->product->price_after_discount ,
                            ],
                            'quantity' => $element->quantity,
                            'adjustable_quantity' => [
                                'enabled' => true,
                                'maximum' => 100,
                                'minimum' => 0,
                            ],
                        ];
                    })->toArray();
                    return $payment = Auth::user()->checkout(null,[
                        'success_url' => route('customer.checkout-success', ['status' => 'success']) . '?session_id={CHECKOUT_SESSION_ID}',
                        // 'currency' => 'EGP',
                        'line_items' => $products,
                    ]);
                    // dd($payment);
                    // return $payment = Auth::user()->checkoutCharge($totalPrice,'products',$cart->quantity,[
                    //         'success_url' => route('customer.checkout-success', ['status' => 'success']) . '?session_id={CHECKOUT_SESSION_ID}',
                    //     ]);
                    // dd($payment);
            }

            if($request->paymemnt == 'cash'){
                $order = new Order();
                $order->name = $request->name;
                $order->email = $request->email;
                $order->address = $request->address;
                $order->phone = $request->phone;
                $order->note = $request->note;
                $order->user_id = Auth::user()->id;
                $order->payment = 'cash';
                $order->status = 'pending';
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
                // App\Models\Cart::where('user_id',auth()->user()->id)->delete();
                return redirect()->route('customer.home','requested');
            }

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
