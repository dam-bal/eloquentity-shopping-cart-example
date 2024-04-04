<?php

namespace App\Repositories\Interfaces;

use App\Entities\Cart;

interface CartRepository
{
    public function get(string $id): Cart;

    public function store(Cart $cart): void;
}
