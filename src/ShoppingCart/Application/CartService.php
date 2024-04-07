<?php

namespace Core\ShoppingCart\Application;

use Core\Shared\Domain\IdInterface;
use Core\ShoppingCart\Domain\Cart;
use Core\ShoppingCart\Domain\CartRepository;

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

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function getCartDto(string $cartId): CartDto
    {
        return CartDto::createFromCartDomainObject($this->cartRepository->get($cartId));
    }
}
