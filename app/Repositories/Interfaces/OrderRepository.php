<?php

namespace App\Repositories\Interfaces;

use App\Entities\Order;

interface OrderRepository
{
    public function get(string $id): Order;

    public function store(Order $order): void;
}
