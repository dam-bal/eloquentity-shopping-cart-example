<?php

namespace Core\ShoppingCart\Infrastructure;

use App\Models\Product as ProductEloquentModel;
use Core\ShoppingCart\Domain\Product as ProductEntity;
use Core\ShoppingCart\Domain\ProductRepository;
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
