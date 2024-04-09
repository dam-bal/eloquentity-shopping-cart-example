<?php

namespace Core\ShoppingCart\Application;

use Core\Shared\Application\Command;

final readonly class RemoveProductFromCart implements Command
{
    public function __construct(
        public string $productId,
        public string $cartId
    ) {
    }
}
