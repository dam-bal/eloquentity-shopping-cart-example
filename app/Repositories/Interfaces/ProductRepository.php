<?php

namespace App\Repositories\Interfaces;

use App\Entities\Product;

interface ProductRepository
{
    public function get(string $id): Product;

    public function store(Product $product): void;
}
