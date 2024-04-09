<?php

namespace Tests\Unit\Core\ShoppingCart\Application;

use Core\ShoppingCart\Application\CreateOrderFromCartCommand;
use Core\ShoppingCart\Application\CreateOrderFromCartCommandHandler;
use Core\ShoppingCart\Domain\OrderService;
use Core\ShoppingCart\Domain\PaymentMethod;
use Core\ShoppingCart\Domain\Shipment;
use PHPUnit\Framework\TestCase;

class CreateOrderFromCartCommandHandlerTest extends TestCase
{
    public function testItCallsCreateOrderFromCartInOrderService(): void
    {
        $orderServiceMock = $this->createMock(OrderService::class);

        $shipmentMock = $this->createMock(Shipment::class);

        $orderServiceMock
            ->expects($this->once())
            ->method('createOrderFromCart')
            ->with(
                'orderId',
                'cartId',
                $shipmentMock,
                PaymentMethod::CARD
            );

        $createOrderFromCartCommandHandler = new CreateOrderFromCartCommandHandler($orderServiceMock);

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
