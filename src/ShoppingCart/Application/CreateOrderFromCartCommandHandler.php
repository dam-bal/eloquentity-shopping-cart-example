<?php

namespace Core\ShoppingCart\Application;

use Core\ShoppingCart\Domain\CartRepository;
use Core\ShoppingCart\Domain\OrderService;

final readonly class CreateOrderFromCartCommandHandler
{
    public function __construct(
        private CartRepository $cartRepository,
        private OrderService $orderService
    ) {
    }

    public function __invoke(CreateOrderFromCartCommand $command): void
    {
        $cart = $this->cartRepository->get($command->cartId);

        $this->orderService->createOrderFromCart(
            $command->orderId,
            $cart,
            $command->shipment,
            $command->paymentMethod
        );
    }
}
