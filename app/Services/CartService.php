<?php

namespace App\Services;

use App\Entities\Cart;
use App\IdInterface;
use App\Repositories\Interfaces\CartRepository;

readonly class CartService
{
    public function __construct(
        private CartRepository $cartRepository,
        private IdInterface    $idProvider
    )
    {
    }

    public function createCart(string $customerId): Cart
    {
        $cart = new Cart($this->idProvider->getId(), $customerId);

        $this->cartRepository->store($cart);

        return $cart;
    }
}
