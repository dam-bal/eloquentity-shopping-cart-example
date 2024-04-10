<?php

namespace Tests\Unit\Core\ShoppingCart\Domain;

use Core\ShoppingCart\Domain\CartItem;
use Core\ShoppingCart\Domain\Product;
use PHPUnit\Framework\TestCase;

class CartItemTest extends TestCase
{
    public function testIncreaseIncreasesQuantity(): void
    {
        $cartItem = new CartItem($this->getProduct());

        $cartItem->increase();

        self::assertEquals(2, $cartItem->getQuantity());
    }

    public function testDecreaseDecreasesQuantity(): void
    {
        $cartItem = new CartItem($this->getProduct());

        $cartItem->decrease();

        self::assertEquals(0, $cartItem->getQuantity());
    }

    public function testDecreaseDoesNotDecreaseBelowZero(): void
    {
        $cartItem = new CartItem($this->getProduct(), 0);

        $cartItem->decrease();

        self::assertEquals(0, $cartItem->getQuantity());
    }

    private function getProduct(): Product
    {
        return new Product(
            'product-id',
            'Product',
            'Sku',
            10.0
        );
    }
}
