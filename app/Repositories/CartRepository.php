<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Repositories\Interfaces\CartRepositoryInterface;

class CartRepository implements CartRepositoryInterface
{
    protected $model;

    public function __construct(Cart $model)
    {
        $this->model = $model;
    }

    public function getUserCartItems(int $userId)
    {
        return $this->model->where('user_id', $userId)->with('product')->get();
    }

    public function addToCart(int $userId, int $productId, int $quantity)
    {
        return $this->model->create([
            'user_id' => $userId,
            'product_id' => $productId,
            'quantity' => $quantity,
        ]);
    }

    public function updateCartItem(int $userId, int $productId, int $quantity)
    {
        return $this->model->where('user_id', $userId)
            ->where('product_id', $productId)
            ->update(['quantity' => $quantity]);
    }

    public function removeFromCart(int $userId, int $cartId)
    {
        return $this->model->where('user_id', $userId)->where('id', $cartId)->delete();
    }

    public function findCartItem(int $userId, int $productId)
    {
        return $this->model->where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();
    }

    public function getCartTotal(int $userId)
    {
        $cartItems = $this->getUserCartItems($userId);
        return $cartItems->sum(function ($item) {
            return ceil(($item->product->price_after_discount * $item->quantity) + 0.20);
        });
    }

    public function getCartSubtotal(int $userId)
    {
        $cartItems = $this->getUserCartItems($userId);
        return $cartItems->sum(function ($item) {
            return $item->product->price_after_discount * $item->quantity;
        });
    }

    public function getCartCount(int $userId)
    {
        return $this->model->where('user_id', $userId)->sum('quantity');
    }

    public function clearUserCart(int $userId)
    {
        return $this->model->where('user_id', $userId)->delete();
    }
}
