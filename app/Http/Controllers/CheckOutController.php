<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Models\OrderDetail;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Laravel\Cashier\Checkout;

class CheckOutController extends Controller
{
    protected $cartRepository;
    protected $orderRepository;

    public function __construct(CartRepositoryInterface $cartRepository, OrderRepositoryInterface $orderRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['cartItems'] = $this->cartRepository->getUserCartItems(Auth::user()->id);


        // Get first cart item for any additional processing if needed
        $cartItems = $this->cartRepository->getUserCartItems(Auth::user()->id);
        $cart = $cartItems->first();



        return view('shop.cart.checkout', $data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cart = $this->cartRepository->getUserCartItems(Auth::user()->id);


        $prices = [];

        foreach ($cart as $item) {
            if ($item->product) {
                $prices[$item->product->stripe_price_id] = $item->quantity;
            }
        }
        // return $prices;

        // dd(Auth::user()->checkout($prices));

        $validator = Validator::make($request->all(), [
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
            $totalPrice = collect(Cart::with('product')->get())->sum(function ($item) {
                return $item->product->price_after_discount * $item->quantity;
            });
            $subTotal = collect(Cart::with('product')->get())->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            if ($request->payment == 'visa') {




                // return $payment = Auth::user()->checkout(['price_1QgqWY4ROQ2T8rH2mClSz5sw' => 2],[
                //     'success_url' => route('customer.checkout-success',['session_id' => 's']),
                // ]);
                // $sessionOrderId = Session::put('orderid',$order->id);

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
                return $payment = Auth::user()->checkout(null, [
                    'success_url' => route('customer.checkout-success', ['status' => 'success']) . '?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => route('customer.checkout-cancel', ['status' => 'cancelled']) . '?session_id={CHECKOUT_SESSION_ID}',
                    'line_items' => $products,
                    'metadata' => [
                        'cart_id' => implode(',', $cart_ids),
                        'name' => $request->name,
                        'email' => $request->email,
                        'address' => $request->address,
                        'phone' => $request->phone,
                        'note' => $request->note,
                        'totalPrice' => $totalPrice,
                        'subTotal' => $subTotal,
                    ],
                ]);

                dd($payment);
                // dd($totalPrice + 0.20);
                // return $payment = Auth::user()->checkoutCharge(ceil($totalPrice + 0.20),'products',$cart->quantity,[
                //         'success_url' => route('customer.checkout-success', ['status' => 'success']) . '?session_id={CHECKOUT_SESSION_ID}',
                //         'cancel_url' => route('customer.checkout-cancel', ['status' => 'cancelled']) . '?session_id={CHECKOUT_SESSION_ID}',
                //         'metadata' => [
                //             'cart_id' => $cart->id,
                //         ],
                //     ]);
                // dd($payment);
            }

            if ($request->payment == 'cash') {
                $order = $this->orderRepository->create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'note' => $request->note,
                    'user_id' => Auth::user()->id,
                    'payment' => 'cash',
                    'status' => 'pending',
                    'totalprice' => $totalPrice + Setting::getTaxRate(),
                    'subtotal' => $subTotal + Setting::getTaxRate(),
                ]);

                $cartproducts = $this->cartRepository->getUserCartItems(Auth::user()->id);

                foreach ($cartproducts as $cart) {
                    $newOrderDetail = new OrderDetail();
                    $newOrderDetail->product_id = $cart->product_id;
                    $newOrderDetail->price = $cart->product->price_after_discount;
                    $newOrderDetail->quantity = $cart->quantity;
                    $newOrderDetail->order_id = $order->id;
                    $newOrderDetail->save();
                }
                // App\Models\Cart::where('user_id',auth()->user()->id)->delete();
                return redirect()->route('customer.home', 'requested');
            }
        }
    }
}
