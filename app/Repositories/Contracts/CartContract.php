<?php

namespace App\Repositories\Contracts;

interface CartContract extends BaseContract
{
    public function getUserCartItems(int $userId);
    public function addToCart(int $userId, int $productId, int $quantity);
    public function updateCartItem(int $userId, int $productId, int $quantity);
    public function removeFromCart(int $userId, int $cartId);
    public function findCartItem(int $userId, int $productId);

    public function getCartCount(int $userId);
    public function clearUserCart(int $userId);
}
