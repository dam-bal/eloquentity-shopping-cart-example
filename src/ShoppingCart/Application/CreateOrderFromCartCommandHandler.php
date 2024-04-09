<?php

namespace Core\ShoppingCart\Application;

use Core\ShoppingCart\Domain\OrderService as DomainOrderService;

final readonly class CreateOrderFromCartCommandHandler
{
    public function __construct(
        private DomainOrderService $orderService
    ) {
    }

    public function __invoke(CreateOrderFromCartCommand $command): void
    {
        $this->orderService->createOrderFromCart(
            $command->orderId,
            $command->cartId,
            $command->shipment,
            $command->paymentMethod
        );
    }
}
