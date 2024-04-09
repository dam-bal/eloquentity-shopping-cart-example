<?php

namespace Core\ShoppingCart\Infrastructure;

use Core\ShoppingCart\Application\GetOrderQuery;
use Core\ShoppingCart\Application\OrderDto;
use Core\ShoppingCart\Domain\OrderRepository;

readonly class GetOrderQueryHandler
{
    public function __construct(
        private OrderRepository $orderRepository
    ) {
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function __invoke(GetOrderQuery $query): OrderDto
    {
        return OrderDto::createFromOrderDomainObject($this->orderRepository->get($query->orderId));
    }
}
