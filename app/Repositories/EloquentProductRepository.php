<?php

namespace App\Repositories;

use App\Entities\Product as ProductEntity;
use App\Models\Product as ProductEloquentModel;
use App\Repositories\Interfaces\ProductRepository;
use Eloquentity\Eloquentity;

final readonly class EloquentProductRepository implements ProductRepository
{
    public function __construct(private Eloquentity $eloquentity)
    {
    }

    public function get(string $id): ProductEntity
    {
        return $this->eloquentity->map(ProductEloquentModel::query()->findOrFail($id), ProductEntity::class);
    }

    public function store(ProductEntity $product): void
    {
        $this->eloquentity->persist($product, ProductEloquentModel::class);
    }
}
