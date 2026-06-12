<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Repositories\Contracts\CartContract;
use App\Repositories\Contracts\ProductContract;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use function Symfony\Component\String\b;

use App\Services\CartService;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Requests\AddToCartRequest;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
        $this->middleware('auth')->only(['edit', 'update']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            DB::beginTransaction();

            $data = $this->cartService->getCartIndexData();

            DB::commit();

            return view('shop.cart.index', $data);
        } catch (Exception $e) {
            DB::rollBack();

            Log::error('Cart update failed: ' . $e->getMessage(), [
                'exception' => $e
            ]);

            return back()->withErrors(['error' => 'Something went wrong, please try again later.']);
        }
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

            $data = $this->cartService->getCartEditData();

            DB::commit();

            return view('shop.cart.update', $data);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Cart update failed: ' . $e->getMessage(), [
                'exception' => $e
            ]);

            return back()->withErrors(['error' => 'Something went wrong, please try again later.']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('customer.cart.index');
        }

        try {
            DB::beginTransaction();

            $success = $this->cartService->updateCart($request->product_id, $request->quantity);

            if ($success) {
                DB::commit();
            } else {
                DB::rollBack();
            }

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
        $this->cartService->destroyCartItem($id);
        return back();
    }

    public function addToCart(AddToCartRequest $request)
    {
        $result = $this->cartService->addToCart($request->productid, $request->input('quantity', 1));

        if ($request->expectsJson()) {
            return response()->json([
                'success' => $result['success'],
                'message' => $result['message']
            ], $result['success'] ? 200 : 400);
        }

        if ($result['success']) {
            return back()->with('success', $result['message']);
        } else {
            return back()->with('error', $result['message']);
        }
    }

    public function count()
    {
        $count = $this->cartService->count();
        return response()->json(['count' => $count]);
    }
}
