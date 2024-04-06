<?php

namespace Core\ShoppingCart\Domain;

interface CartRepository
{
    public function get(string $id): Cart;

    public function store(Cart $cart): void;
}
