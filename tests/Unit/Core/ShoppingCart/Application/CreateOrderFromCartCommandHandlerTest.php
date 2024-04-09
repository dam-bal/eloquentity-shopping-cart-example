<?php

namespace Tests\Unit\Core\ShoppingCart\Application;

use Core\ShoppingCart\Application\CreateOrderFromCartCommand;
use Core\ShoppingCart\Application\CreateOrderFromCartCommandHandler;
use Core\ShoppingCart\Domain\Cart;
use Core\ShoppingCart\Domain\CartRepository;
use Core\ShoppingCart\Domain\OrderService;
use Core\ShoppingCart\Domain\PaymentMethod;
use Core\ShoppingCart\Domain\Shipment;
use PHPUnit\Framework\TestCase;

class CreateOrderFromCartCommandHandlerTest extends TestCase
{
    public function testItCallsCreateOrderFromCartInOrderService(): void
    {
        $cartRepositoryMock = $this->createMock(CartRepository::class);

        $cartMock = $this->createMock(Cart::class);

        $cartRepositoryMock
            ->method('get')
            ->with('cartId')
            ->willReturn($cartMock);

        $orderServiceMock = $this->createMock(OrderService::class);

        $shipmentMock = $this->createMock(Shipment::class);

        $orderServiceMock
            ->expects($this->once())
            ->method('createOrderFromCart')
            ->with(
                'orderId',
                $cartMock,
                $shipmentMock,
                PaymentMethod::CARD
            );

        $createOrderFromCartCommandHandler = new CreateOrderFromCartCommandHandler(
            $cartRepositoryMock,
            $orderServiceMock
        );

        $createOrderFromCartCommandHandler(
            new CreateOrderFromCartCommand(
                'orderId',
                'cartId',
                $shipmentMock,
                PaymentMethod::CARD
            )
        );
    }
}
