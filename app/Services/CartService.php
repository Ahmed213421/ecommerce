<?php

namespace App\Services;

use App\Repositories\Contracts\CartContract;
use App\Repositories\Contracts\ProductContract;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CartService
{
    protected $cartRepository;
    protected $productRepository;

    public function __construct(CartContract $cartRepository, ProductContract $productRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
    }

    public function getCartIndexData()
    {
        $total = 0;
        $subtotal = 0;
        $cartItems = [];

        if (Auth::check()) {
            $cartItems = $this->cartRepository->getUserCartItems(Auth::user()->id);
            $subtotal = $this->calculateSubtotal($cartItems);
            $total = $this->calculateTotal($cartItems);
        } else {
            $cartItems = session('cart', []);
            $subtotal = collect($cartItems)->sum(function ($item) {
                return ceil($item['price_after_discount'] * $item['quantity'] + 0.20);
            });
            $total = collect($cartItems)->sum(function ($item) {
                return $item['price_after_discount'] * $item['quantity'];
            });
        }

        return compact('cartItems', 'total', 'subtotal');
    }

    public function getCartEditData()
    {
        $total = 0;
        $subtotal = 0;
        $cartItems = [];

        if ($this->cartRepository->getCartCount(Auth::user()->id) == 0) {
            toastr()->warning('please fill out products');
        }

        $cartItems = $this->cartRepository->getUserCartItems(Auth::user()->id);
        $subtotal = $this->calculateSubtotal($cartItems);
        $total = $this->calculateTotal($cartItems);

        return compact('cartItems', 'total', 'subtotal');
    }

    public function updateCart(int $productId, int $quantity)
    {
        $product = $this->productRepository->find($productId);

        $cartItem = $this->cartRepository->findCartItem(Auth::user()->id, $productId);
        
        $newQuantity = $cartItem->quantity + $quantity;
        if ($newQuantity > $product->quantity) {
            toastr()->warning('Not enough stock available');
            return false;
        }

        $this->cartRepository->updateCartItem(Auth::user()->id, $productId, $quantity);
        toastr()->success(__('toaster.update'));
        return true;
    }

    public function destroyCartItem($id)
    {
        if (Auth::check()) {
            $deleted = $this->cartRepository->removeFromCart(Auth::user()->id, $id);
            if ($deleted) {
                toastr()->success(__('toaster.del'));
            }
        } else {
            $cart = session('cart', []);
            if (isset($cart[$id])) {
                unset($cart[$id]);
                session(['cart' => $cart]);
                toastr()->success(__(trans('toaster.del')));
            }
        }
    }

    public function addToCart(int $productId, int $requestedQty)
    {
        $product = $this->productRepository->find($productId);

        if (!$product || $product->quantity == 0) {
            return ['success' => false, 'message' => 'Product is out of stock'];
        }

        if (Auth::check()) {
            $userId = Auth::id();
            $cartItem = $this->cartRepository->findCartItem($userId, $productId);

            if ($cartItem) {
                if (($cartItem->quantity + $requestedQty) > $product->quantity) {
                    return ['success' => false, 'message' => 'Not enough stock available'];
                }
                $this->cartRepository->updateCartItem($userId, $productId, $cartItem->quantity + $requestedQty);
            } else {
                if ($requestedQty > $product->quantity) {
                    return ['success' => false, 'message' => 'Not enough stock available'];
                }
                $this->cartRepository->addToCart($userId, $productId, $requestedQty);
            }
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$productId])) {
                if (($cart[$productId]['quantity'] + $requestedQty) > $product->quantity) {
                    return ['success' => false, 'message' => 'Not enough stock available'];
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

        return ['success' => true, 'message' => __('toaster.cart')];
    }

    public function count()
    {
        if (Auth::check()) {
            return $this->cartRepository->getCartCount(Auth::id());
        } else {
            $cart = session('cart', []);
            return array_sum(array_column($cart, 'quantity'));
        }
    }

    public function calculateTotal($cartItems)
    {
        return collect($cartItems)->sum(function ($item) {
            return ceil(($item->product->price_after_discount * $item->quantity) + 0.20);
        });
    }

    public function calculateSubtotal($cartItems)
    {
        return collect($cartItems)->sum(function ($item) {
            return $item->product->price_after_discount * $item->quantity;
        });
    }
}
