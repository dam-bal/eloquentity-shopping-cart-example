<?php

namespace Core\ShoppingCart\Application;

use Core\ShoppingCart\Domain\Cart;
use Core\ShoppingCart\Domain\CartItem;

final readonly class CartDto
{
    /**
     * @param CartItemDto[] $items
     */
    public function __construct(
        public string $customerId,
        public array $items,
    ) {
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public static function createFromCartDomainObject(Cart $cart): self
    {
        return new self(
            $cart->customerId,
            array_map(
                static fn(CartItem $cartItem): CartItemDto => CartItemDto::createFromCartItemDomainObject($cartItem),
                $cart->getItems()
            )
        );
    }
}
