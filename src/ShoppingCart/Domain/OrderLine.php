<?php

namespace Core\ShoppingCart\Domain;

use JsonSerializable;

readonly class OrderLine implements JsonSerializable
{
    public function __construct(
        public string $name,
        public string $sku,
        public float  $unitPrice,
        public int    $quantity
    )
    {
    }

    public function getTotalPrice(): float
    {
        return $this->unitPrice * $this->quantity;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'name' => $this->name,
            'sku' => $this->sku,
            'unitPrice' => $this->unitPrice,
            'quantity' => $this->quantity,
            'price' => $this->getTotalPrice()
        ];
    }
}
