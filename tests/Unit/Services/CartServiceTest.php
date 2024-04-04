<?php

namespace Tests\Unit\Services;

use App\Entities\Cart;
use App\IdInterface;
use App\Repositories\Interfaces\CartRepository;
use App\Services\CartService;
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
