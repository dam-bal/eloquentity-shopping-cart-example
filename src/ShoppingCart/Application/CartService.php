<?php

namespace Core\ShoppingCart\Application;

use Core\ShoppingCart\Domain\CartRepository;

readonly class CartService
{
    public function __construct(private CartRepository $cartRepository)
    {
    }

    public function getCartDto(string $cartId): CartDto
    {
        return CartDto::createFromCartDomainObject($this->cartRepository->get($cartId));
    }
}
