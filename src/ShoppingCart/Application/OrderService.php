<?php

namespace Core\ShoppingCart\Application;

use Core\ShoppingCart\Domain\OrderRepository;

readonly class OrderService
{
    public function __construct(private OrderRepository $orderRepository)
    {
    }

    public function getOrderDto(string $orderId): OrderDto
    {
        return OrderDto::createFromOrderDomainObject(
            $this->orderRepository->get($orderId)
        );
    }
}
