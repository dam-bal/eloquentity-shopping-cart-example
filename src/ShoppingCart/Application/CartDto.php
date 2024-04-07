<?php

namespace Core\ShoppingCart\Application;

use Core\ShoppingCart\Domain\Cart;
use Core\ShoppingCart\Domain\CartItem;
use JsonSerializable;

readonly final class CartDto implements JsonSerializable
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

    public function jsonSerialize(): mixed
    {
        return [
            'customer_id' => $this->customerId,
            'items' => $this->items
        ];
    }
}
