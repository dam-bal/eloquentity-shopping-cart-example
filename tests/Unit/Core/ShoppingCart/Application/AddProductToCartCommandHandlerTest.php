<?php

namespace Tests\Unit\Core\ShoppingCart\Application;

use Core\ShoppingCart\Application\AddProductToCartCommand;
use Core\ShoppingCart\Application\AddProductToCartCommandHandler;
use Core\ShoppingCart\Domain\Cart;
use Core\ShoppingCart\Domain\CartRepository;
use Core\ShoppingCart\Domain\Product;
use Core\ShoppingCart\Domain\ProductRepository;
use PHPUnit\Framework\TestCase;

class AddProductToCartCommandHandlerTest extends TestCase
{
    public function testItAddsProductToCart(): void
    {
        $productRepository = $this->createMock(ProductRepository::class);

        $productMock = $this->createMock(Product::class);

        $productRepository
            ->method('get')
            ->with('productId')
            ->willReturn($productMock);

        $cartRepository = $this->createMock(CartRepository::class);

        $cartMock = $this->createMock(Cart::class);

        $cartMock
            ->expects($this->once())
            ->method('addProduct')
            ->with($productMock);

        $cartRepository
            ->method('get')
            ->with('cartId')
            ->willReturn($cartMock);

        $addProductToCartCommandHandler = new AddProductToCartCommandHandler($cartRepository, $productRepository);

        $addProductToCartCommandHandler(new AddProductToCartCommand('productId', 'cartId'));
    }
}
