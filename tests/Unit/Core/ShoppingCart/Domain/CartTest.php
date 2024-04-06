<?php

namespace Tests\Unit\Core\ShoppingCart\Domain;

use Core\ShoppingCart\Domain\Cart;
use Core\ShoppingCart\Domain\CartItem;
use Core\ShoppingCart\Domain\Product;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    public function test_add_product_adds_product(): void
    {
        $cart = new Cart('cart-id', 'customer-id');

        $product = new Product('product-id', 'Product', 'Sku', 15.0);

        $cart->addProduct($product);

        self::assertEquals(
            [new CartItem($product)],
            $cart->getItems()
        );
    }

    public function test_add_product_adds_another_product(): void
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

    public function test_remove_product_removes_product(): void
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
}
