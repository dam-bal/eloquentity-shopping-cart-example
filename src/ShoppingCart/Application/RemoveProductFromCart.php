<?php

namespace Core\ShoppingCart\Application;

use Core\Shared\Application\CommandInterface;

final readonly class RemoveProductFromCart implements CommandInterface
{
    public function __construct(
        public string $productId,
        public string $cartId
    ) {
    }
}