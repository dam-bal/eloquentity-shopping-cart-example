<?php

namespace Core\ShoppingCart\Application;

use Core\Shared\Application\Command;

final readonly class CreateCartForCustomerCommand implements Command
{
    public function __construct(
        public string $cartId,
        public string $customerId
    ) {
    }
}
