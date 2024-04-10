<?php

namespace Core\ShoppingCart\Application;

use Core\ShoppingCart\Domain\CartItem;

final readonly class CartItemDto
{
    public function __construct(
        public string $productId,
        public int $quantity
    ) {
    }

    public static function createFromCartItemDomainObject(CartItem $cartItem): self
    {
        return new self(
            $cartItem->productId,
            $cartItem->getQuantity()
        );
    }
}
