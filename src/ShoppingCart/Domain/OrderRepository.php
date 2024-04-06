<?php

namespace Core\ShoppingCart\Domain;

interface OrderRepository
{
    public function get(string $id): Order;

    public function store(Order $order): void;
}
