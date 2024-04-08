<?php

namespace Tests\Unit\Core\ShoppingCart\Application;

use Core\Shared\Domain\IdInterface;
use Core\ShoppingCart\Application\CartService;
use Core\ShoppingCart\Domain\Cart;
use Core\ShoppingCart\Domain\CartRepository;
use Illuminate\Foundation\Testing\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class CartServiceTest extends TestCase
{
    private CartRepository|MockObject $cartRepositoryMock;

    private IdInterface|MockObject $idMock;

    private CartService $sut;

    protected function setUp(): void
    {
        $this->cartRepositoryMock = $this->createMock(CartRepository::class);
        $this->idMock = $this->createMock(IdInterface::class);

        $this->sut = new CartService(
            $this->cartRepositoryMock,
            $this->idMock
        );
    }

    public function test_createCart_creates_cart(): void
    {
         $this->idMock
             ->method('getId')
             ->willReturn('cart-id');

         $expectedCart = new Cart('cart-id', 'customer-id');

         $this->cartRepositoryMock
             ->expects(self::once())
             ->method('store')
             ->with($expectedCart);

         self::assertEquals(
             $expectedCart,
             $this->sut->createCart('customer-id')
         );
    }
}