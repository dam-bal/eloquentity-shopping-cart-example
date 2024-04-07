<?php

namespace Core\ShoppingCart\Domain;

use Core\Shared\Domain\IdInterface;

readonly class CartService
{
    public function __construct(
        private CartRepository $cartRepository,
        private IdInterface $idProvider
    ) {
    }

    public function createCart(string $customerId): Cart
    {
        $cart = new Cart($this->idProvider->getId(), $customerId);

        $this->cartRepository->store($cart);

        return $cart;
    }
}
