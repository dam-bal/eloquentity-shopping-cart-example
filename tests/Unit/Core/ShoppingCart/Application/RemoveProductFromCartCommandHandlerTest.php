<?php

namespace Tests\Unit\Core\ShoppingCart\Application;

use Core\ShoppingCart\Application\RemoveProductFromCartCommand;
use Core\ShoppingCart\Application\RemoveProductFromCartCommandHandler;
use Core\ShoppingCart\Domain\Cart;
use Core\ShoppingCart\Domain\CartRepository;
use Core\ShoppingCart\Domain\Product;
use Core\ShoppingCart\Domain\ProductRepository;
use PHPUnit\Framework\TestCase;

class RemoveProductFromCartCommandHandlerTest extends TestCase
{
    public function testItRemovesProductFromCart(): void
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
            ->method('removeProduct')
            ->with($productMock);

        $cartRepository
            ->method('get')
            ->with('cartId')
            ->willReturn($cartMock);

        $removeProductFromCartCommandHandler = new RemoveProductFromCartCommandHandler(
            $cartRepository,
            $productRepository
        );

        $removeProductFromCartCommandHandler(new RemoveProductFromCartCommand('productId', 'cartId'));
    }
}
