<?php

namespace Core\ShoppingCart\Application;

use Core\ShoppingCart\Domain\CartItem;
use JsonSerializable;

readonly final class CartItemDto implements JsonSerializable
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

    public function jsonSerialize(): mixed
    {
        return [
            'product_id' => $this->productId,
            'quantity' => $this->quantity,
        ];
    }
}
