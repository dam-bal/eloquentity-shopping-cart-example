<?php

namespace Core\ShoppingCart\Application;

use Core\Shared\Application\Query;

/** @implements Query<OrderDto> */
readonly class GetOrderQuery implements Query
{
    public function __construct(public string $orderId)
    {
    }
}
