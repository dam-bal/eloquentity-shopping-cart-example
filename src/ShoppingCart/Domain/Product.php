<?php

namespace Core\ShoppingCart\Domain;

class Product extends Entity
{
    public function __construct(
        ?string                $id,
        public readonly string $name,
        public readonly string $sku,
        public readonly float  $price
    )
    {
        $this->setId($id);
    }
}
