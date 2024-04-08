<?php

namespace Core\ShoppingCart\Domain;

use Core\Shared\Domain\Entity;

class Product extends Entity
{
    public function __construct(
        string $id,
        public readonly string $name,
        public readonly string $sku,
        public readonly float $price
    ) {
        $this->setId($id);
    }
}
