<?php

namespace Core\ShoppingCart\Application;

use Core\ShoppingCart\Domain\OrderLine;
use JsonSerializable;

readonly final class OrderLineDto implements JsonSerializable
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

    public function jsonSerialize(): mixed
    {
        return [
            'name' => $this->name,
            'sku' => $this->sku,
            'unit_price' => $this->unitPrice,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ];
    }
}
