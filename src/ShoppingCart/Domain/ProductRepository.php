<?php

namespace Core\ShoppingCart\Domain;

interface ProductRepository
{
    public function get(string $id): Product;

    public function store(Product $product): void;
}
