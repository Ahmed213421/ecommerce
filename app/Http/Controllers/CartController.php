<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $total = 0;
    $cartItems = [];

    if (Auth::check()) {

        $cartItems = Cart::where('user_id', Auth::user()->id)->with('product')->get();


        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price_after_discount * $item->quantity;
        });
        $total = $cartItems->sum(function ($item) {
            return ceil(($item->product->price_after_discount * $item->quantity) + 0.20);
        });
    } else {

        $cartItems = session('cart', []);

        $total = collect($cartItems)->sum(function ($item) {
            return $item['price_after_discount'] * $item['quantity'];
        });

        $subtotal = collect($cartItems)->sum(function ($item) {
            return ceil($item['price_after_discount'] * $item['quantity'] + 0.20);
        });
    }

    // session()->flush();

    return view('shop.cart.index', compact('cartItems', 'total','subtotal'));
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
    public function destroy($id)
    {
    if (Auth::check()) {
        // User is logged in, remove the cart item from the database
        $cartItem = Cart::where('user_id', Auth::user()->id)->where('id', $id)->first();

        if ($cartItem) {
            $cartItem->delete();
            toastr()->success(__('toaster.del'));
        }
    } else {

        $cart = session('cart', []);
        // dd($cart);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
            toastr()->success(__(trans('toaster.del')));
        }
    }

    // Redirect back to the cart page
    return back();
}


    public function addToCart(Request $request){

        // return $request;

        $validator = Validator::make($request->all(),[
            'productid' => 'required|exists:products,id',
            'quantity' => 'numeric|min:1|max:100',
        ]);

        if ($validator->fails()) {
            // Redirect back to the form with the error messages
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        if (Auth::check()) {
            // User is logged in, save to the database

            $result = Cart::where('user_id', Auth::user()->id)
                ->where('product_id', $request->productid)
                ->first();

            if ($result) {

                $result->quantity +=  $request->input('quantity', 1);
                $result->save();
            } else {

                $newcart = new Cart();
                $newcart->user_id = Auth::user()->id;
                $newcart->product_id = $request->productid;
                $newcart->quantity = $request->input('quantity', 1);
                $newcart->save();
            }
        } else {

            $cart = session()->get('cart', []);

            if (isset($cart[$request->productid])) {

                $cart[$request->productid]['quantity'] += $request->input('quantity', 1);
            } else {

                $cart[$request->productid] = [
                    'product_id' => $request->productid,
                    'image' => Product::find($request->productid)->imagepath,
                    'name' => Product::find($request->productid)->name,
                    'price' => Product::find($request->productid)->price_after_discount,
                    'quantity' => $request->input('quantity', 1),
                ];
            }

            session()->put('cart', $cart);
        }

        toastr()->success(__('toaster.cart'));

        return back();

    }
}
