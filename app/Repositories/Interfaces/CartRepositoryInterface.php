<?php

namespace App\Repositories\Interfaces;

interface CartRepositoryInterface
{
    public function getUserCartItems(int $userId);
    public function addToCart(int $userId, int $productId, int $quantity);
    public function updateCartItem(int $userId, int $productId, int $quantity);
    public function removeFromCart(int $userId, int $cartId);
    public function findCartItem(int $userId, int $productId);
    public function getCartTotal(int $userId);
    public function getCartSubtotal(int $userId);
    public function getCartCount(int $userId);
    public function clearUserCart(int $userId);
}
