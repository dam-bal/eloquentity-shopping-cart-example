<?php

namespace Core\ShoppingCart\Domain;

readonly class OrderLine
{
    public function __construct(
        public string $name,
        public string $sku,
        public float $unitPrice,
        public int $quantity
    ) {
    }

    public function getTotalPrice(): float
    {
        return $this->unitPrice * $this->quantity;
    }
}
