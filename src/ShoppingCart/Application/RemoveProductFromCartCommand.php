<?php

namespace Core\ShoppingCart\Application;

use Core\Shared\Application\Command;

final readonly class RemoveProductFromCartCommand implements Command
{
    public function __construct(
        public string $productId,
        public string $cartId
    ) {
    }
}
