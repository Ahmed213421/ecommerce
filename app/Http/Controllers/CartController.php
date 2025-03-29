<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use function Symfony\Component\String\b;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            DB::beginTransaction(); // Start transaction

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
                DB::commit(); // Commit transaction

                return view('shop.cart.index', compact('cartItems', 'total', 'subtotal'));
            }
        } catch (Exception $e) {
            DB::rollBack(); // Rollback transaction on error


            Log::error('Cart update failed: ' . $e->getMessage(), [
                'exception' => $e
            ]);

            return back()->withErrors(['error' => 'Something went wrong, please try again later.']);
        }

        // session()->flush();

        return view('shop.cart.index', compact('cartItems', 'total', 'subtotal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        try {
            DB::beginTransaction();


            $total = 0;
            $subtotal = 0;
            $cartItems = [];

            if(Cart::count() == 0){
                toastr()->warning('please fill out products');
            }

            if (Auth::check()) {
                // Get cart items from the database
                $cartItems = Cart::where('user_id', Auth::user()->id)->with('product')->get();

                $subtotal = $cartItems->sum(function ($item) {
                    return $item->product->price_after_discount * $item->quantity;
                });

                $total = $cartItems->sum(function ($item) {
                    return ceil(($item->product->price_after_discount * $item->quantity) + 0.20);
                });
            } else {

                // Get cart items from the session
                $cartItems = session('cart', []);

                $subtotal = collect($cartItems)->sum(function ($item) {
                    return $item['price_after_discount'] * $item['quantity'];
                });

                $total = collect($cartItems)->sum(function ($item) {
                    return ceil($item['price_after_discount'] * $item['quantity'] + 0.20);
                });
            }

            DB::commit(); // Commit transaction

            return view('shop.cart.update', compact('cartItems', 'total', 'subtotal'));
        } catch (Exception $e) {
            DB::rollBack(); // Rollback transaction on error
            Log::error('Cart update failed: ' . $e->getMessage(), [
                'exception' => $e
            ]);

            return back()->withErrors(['error' => 'Something went wrong, please try again later.']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        try {

            $validator = Validator::make($request->all(), [
                'quantity' => 'numeric|min:1|max:100',
                'product_id' => 'required|exists:products,id',
            ]);

            if ($validator->fails()) {
                // Redirect back to the form with the error messages
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $product_quantity = Product::find($request->product_id)->quantity;

            if (Auth::check()) {

                $result = Cart::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->first();


                    $newQuantity = $result->quantity + $request->input('quantity', 1);
                    if ($newQuantity > $product_quantity) {


                        toastr()->warning('Not enough stock available');
                        return back();
                    }

                    $result->quantity =  $request->quantity;
                    $result->save();

            } else {
                $cart = session()->get('cart', []);

                if (($cart[$request->product_id]['quantity'] + $request->input('quantity', 1)) > $product_quantity) {

                    toastr()->warning('Not enough stock available');
                    return back();
                }

                $cart[$request->product_id]['quantity'] = $request->input('quantity', 1);
                session()->put('cart', $cart);
            }
            toastr()->success(__('toaster.update'));

            DB::commit(); // Commit if successful
            return redirect()->route('customer.cart.index');
        } catch (Exception $e) {
            DB::rollBack();

            Log::error('Cart update failed: ' . $e->getMessage(), [
                'exception' => $e
            ]);

            return back()->withErrors(['error' => 'Something went wrong, please try again later.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (Auth::check()) {

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


    public function addToCart(Request $request)
    {

        // return $request;

        $validator = Validator::make($request->all(), [
            'productid' => 'required|exists:products,id',
            'quantity' => 'numeric|min:1|max:100',
        ]);

        if ($validator->fails()) {
            // Redirect back to the form with the error messages
            return back()
                ->withErrors($validator)
                ->withInput();
        }



        $product_quantity = Product::find($request->productid)->quantity;


        if (Auth::check()) {


            $result = Cart::where('user_id', Auth::user()->id)
                ->where('product_id', $request->productid)
                ->first();

            if ($product_quantity == 0) {
                toastr()->warning('Product is out of stock');
                return back();
            }

            if ($result) {
                if (($result->quantity + $request->input('quantity', 1)) > $product_quantity) {

                    toastr()->warning('Not enough stock available');
                    return back();
                }


                $result->quantity += $request->input('quantity', 1);
                $result->save();
            } else {

                if ($request->input('quantity', 1) > $product_quantity) {
                    toastr()->warning('Not enough stock available');
                    return back();
                }


                $newcart = new Cart();
                $newcart->user_id = Auth::user()->id;
                $newcart->product_id = $request->productid;
                $newcart->quantity = $request->input('quantity', 1);
                $newcart->save();
            }
        } else {

            $cart = session()->get('cart', []);

            if ($product_quantity == 0) {
                toastr()->warning('Product is out of stock');
                return back();
            }






            if (isset($cart[$request->productid])) {
                if (($cart[$request->productid]['quantity'] + $request->input('quantity', 1)) > $product_quantity) {

                    toastr()->warning('Not enough stock available');
                    return back();
                }
                $cart[$request->productid]['quantity'] += $request->input('quantity', 1);
            } else {



                $cart[$request->productid] = [
                    'product_id' => $request->productid,
                    'image' => Product::find($request->productid)->imagepath,
                    'name' => Product::find($request->productid)->name,
                    'price_after_discount' => Product::find($request->productid)->price_after_discount,
                    'quantity' => $request->input('quantity', 1),
                ];
            }


            session()->put('cart', $cart);
        }

        toastr()->success(__('toaster.cart'));

        return back();
    }
}
