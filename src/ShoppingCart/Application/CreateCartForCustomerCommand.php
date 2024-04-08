<?php

namespace Core\ShoppingCart\Application;

use Core\Shared\Application\CommandInterface;

final readonly class CreateCartForCustomerCommand implements CommandInterface
{
    public function __construct(
        public string $cartId,
        public string $customerId
    ) {
    }
}
