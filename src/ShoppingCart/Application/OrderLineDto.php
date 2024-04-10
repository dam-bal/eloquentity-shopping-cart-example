<?php

namespace Core\ShoppingCart\Application;

use Core\ShoppingCart\Domain\OrderLine;

final readonly class OrderLineDto
{
    public function __construct(
        public string $name,
        public string $sku,
        public float $unitPrice,
        public int $quantity,
        public float $price
    ) {
    }

    public static function createFromOrderLineDomainObject(OrderLine $orderLine): self
    {
        return new self(
            $orderLine->name,
            $orderLine->sku,
            $orderLine->unitPrice,
            $orderLine->quantity,
            $orderLine->getTotalPrice()
        );
    }
}
