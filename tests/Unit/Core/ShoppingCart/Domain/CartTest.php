<?php

namespace Tests\Unit\Core\ShoppingCart\Domain;

use Core\ShoppingCart\Domain\Cart;
use Core\ShoppingCart\Domain\CartItem;
use Core\ShoppingCart\Domain\Product;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    public function testAddProductAddsProduct(): void
    {
        $cart = new Cart('cart-id', 'customer-id');

        $product = new Product('product-id', 'Product', 'Sku', 15.0);

        $cart->addProduct($product);

        self::assertEquals(
            [new CartItem($product)],
            $cart->getItems()
        );
    }

    public function testAddingSameProductIncreasesQuantity(): void
    {
        $cart = new Cart('cart-id', 'customer-id');

        $product = new Product('product-id', 'Product', 'Sku', 15.0);

        $cart->addProduct($product);
        $cart->addProduct($product);

        self::assertEquals(
            [new CartItem($product, 2)],
            $cart->getItems()
        );
    }

    public function testRemoveProductDecreasesQuantity(): void
    {
        $cart = new Cart('cart-id', 'customer-id');

        $product = new Product('product-id', 'Product', 'Sku', 15.0);
        $cart->addProduct($product);

        $cart->removeProduct($product);

        self::assertEquals(
            [new CartItem($product, 0)],
            $cart->getItems()
        );
    }


    public function testRemoveDoesNotDecreaseQuantityBelowZero(): void
    {
        $cart = new Cart('cart-id', 'customer-id');

        $product = new Product('product-id', 'Product', 'Sku', 15.0);
        $cart->addProduct($product);

        $cart->removeProduct($product);
        $cart->removeProduct($product);

        self::assertEquals(
            [new CartItem($product, 0)],
            $cart->getItems()
        );
    }
}
