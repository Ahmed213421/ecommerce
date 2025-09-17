<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
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
    protected $cartRepository;
    protected $productRepository;

    public function __construct(CartRepositoryInterface $cartRepository, ProductRepositoryInterface $productRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
        $this->middleware('auth')->only(['edit', 'update']);
    }

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

                $cartItems = $this->cartRepository->getUserCartItems(Auth::user()->id);

                $subtotal = $this->cartRepository->getCartSubtotal(Auth::user()->id);
                $total = $this->cartRepository->getCartTotal(Auth::user()->id);
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
        if (!Auth::check()) {
            return redirect()->route('customer.cart.index');
        }

        try {
            DB::beginTransaction();


            $total = 0;
            $subtotal = 0;
            $cartItems = [];


            if(Cart::count() == 0){
                toastr()->warning('please fill out products');
            }

            $cartItems = Cart::where('user_id', Auth::user()->id)->with('product')->get();

            $subtotal = $cartItems->sum(function ($item) {
                return $item->product->price_after_discount * $item->quantity;
            });

            $total = $cartItems->sum(function ($item) {
                return ceil(($item->product->price_after_discount * $item->quantity) + 0.20);
            });

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
        if (!Auth::check()) {
            return redirect()->route('customer.cart.index');
        }

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

            $result = Cart::where('user_id', Auth::user()->id)
                ->where('product_id', $request->product_id)
                ->first();

            $newQuantity = $result->quantity + $request->input('quantity', 1);
            if ($newQuantity > $product_quantity) {
                toastr()->warning('Not enough stock available');
                return back();
            }

            $result->quantity = $request->quantity;
            $result->save();

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
    $validator = Validator::make($request->all(), [
        'productid' => 'required|exists:products,id',
        'quantity' => 'numeric|min:1|max:100',
    ]);

    if ($validator->fails()) {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        return back()->withErrors($validator)->withInput();
    }

    $product = Product::find($request->productid);

    if (!$product || $product->quantity == 0) {
        $message = 'Product is out of stock';

        return $request->expectsJson()
            ? response()->json(['success' => false, 'message' => $message], 400)
            : back()->with('error', $message);
    }

    if (Auth::check()) {
        $userId = Auth::id();

        $cartItem = Cart::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->first();

        $requestedQty = $request->input('quantity', 1);

        if ($cartItem) {
            if (($cartItem->quantity + $requestedQty) > $product->quantity) {
                $message = 'Not enough stock available';
                return $request->expectsJson()
                    ? response()->json(['success' => false, 'message' => $message], 400)
                    : back()->with('error', $message);
            }

            $cartItem->quantity += $requestedQty;
            $cartItem->save();
        } else {
            if ($requestedQty > $product->quantity) {
                $message = 'Not enough stock available';
                return $request->expectsJson()
                    ? response()->json(['success' => false, 'message' => $message], 400)
                    : back()->with('error', $message);
            }

            Cart::create([
                'user_id' => $userId,
                'product_id' => $product->id,
                'quantity' => $requestedQty,
            ]);
        }
    } else {
        $cart = session()->get('cart', []);
        $productId = $product->id;
        $requestedQty = $request->input('quantity', 1);

        if (isset($cart[$productId])) {
            if (($cart[$productId]['quantity'] + $requestedQty) > $product->quantity) {
                $message = 'Not enough stock available';
                return $request->expectsJson()
                    ? response()->json(['success' => false, 'message' => $message], 400)
                    : back()->with('error', $message);
            }

            $cart[$productId]['quantity'] += $requestedQty;
        } else {
            $cart[$productId] = [
                'product_id' => $productId,
                'image' => $product->imagepath,
                'name' => $product->name,
                'price_after_discount' => $product->price_after_discount,
                'quantity' => $requestedQty,
            ];
        }

        session()->put('cart', $cart);
    }

    return $request->expectsJson()
        ? response()->json(['success' => true, 'message' => __('toaster.cart')])
        : back()->with('success', __('toaster.cart'));
    }

    public function count()
    {
        if (auth()->check()) {
            $count = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity');
        } else {
            $cart = session('cart', []);
            $count = array_sum(array_column($cart, 'quantity'));
        }

        return response()->json(['count' => $count]);
    }


}
