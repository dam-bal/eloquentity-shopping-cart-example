<?php

namespace Core\ShoppingCart\Application;

use Core\Shared\Application\Query;

/** @implements Query<CartDto> */
readonly class GetCartQuery implements Query
{
    public function __construct(public string $cartId)
    {
    }
}
