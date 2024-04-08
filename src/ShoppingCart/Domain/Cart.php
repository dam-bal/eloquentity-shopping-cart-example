<?php

namespace Core\ShoppingCart\Domain;

use Core\Shared\Domain\Entity;

class Cart extends Entity
{
    /** @var CartItem[] */
    private array $items = [];

    private bool $completed = false;

    public function __construct(
        string $id,
        public readonly string $customerId
    ) {
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

    /**
     * @return CartItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function markAsCompleted(): void
    {
        $this->completed = true;
    }

    public function isCompleted(): bool
    {
        return $this->completed;
    }
}
