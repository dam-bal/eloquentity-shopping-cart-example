<?php

namespace App\Entities;

use JsonSerializable;

class Cart extends Entity implements JsonSerializable
{
    /** @var CartItem[] */
    private array $items = [];

    private bool $completed = false;

    public function __construct(
        string                  $id,
        private readonly string $customerId
    )
    {
        $this->setId($id);
    }

    public function addProduct(Product $product): void
    {
        if ($this->isCompleted()) {
            return;
        }

        $item = $this->getItem($product);

        if (!$item) {
            $this->items[] = new CartItem($product);

            return;
        }

        $item->increase();
    }

    public function removeProduct(Product $product): void
    {
        if ($this->isCompleted()) {
            return;
        }

        $this->getItem($product)?->decrease();
    }

    private function getItem(Product $product): ?CartItem
    {
        foreach ($this->items as $item) {
            if ($item->getProduct()->getId() === $product->getId()) {
                return $item;
            }
        }

        return null;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    public function markAsCompleted(): void
    {
        $this->completed = true;
    }

    public function isCompleted(): bool
    {
        return $this->completed;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'customer_id' => $this->customerId,
            'items' => $this->items,
        ];
    }
}
