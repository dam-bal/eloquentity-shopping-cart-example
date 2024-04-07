<?php

namespace Core\ShoppingCart\Domain;

class CartItem
{
    public readonly string $productId;

    public function __construct(
        private readonly Product $product,
        private int $quantity = 1
    ) {
        $this->productId = $this->product->getId();
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function increase(): void
    {
        $this->quantity++;
    }

    public function decrease(): void
    {
        $this->quantity--;

        if ($this->quantity < 0) {
            $this->quantity = 0;
        }
    }
}
