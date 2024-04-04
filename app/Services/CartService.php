<?php

namespace App\Services;

use App\Entities\Cart;
use App\IdInterface;
use App\Repositories\Interfaces\CartRepository;

class CartService
{
    public function __construct(
        private readonly CartRepository $cartRepository,
        private readonly IdInterface    $idProvider
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
