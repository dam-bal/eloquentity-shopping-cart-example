<?php

namespace Core\ShoppingCart\Domain;

use Core\Shared\Domain\Entity;

class Customer extends Entity
{
    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName
    ) {
    }
}
