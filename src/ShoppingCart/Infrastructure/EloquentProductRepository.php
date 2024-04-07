<?php

namespace Core\ShoppingCart\Infrastructure;

use App\Models\Product as ProductEloquentModel;
use Core\ShoppingCart\Domain\Product as ProductEntity;
use Core\ShoppingCart\Domain\ProductRepository;
use Eloquentity\Eloquentity;
use Eloquentity\Exception\EloquentityException;
use ReflectionException;

final readonly class EloquentProductRepository implements ProductRepository
{
    public function __construct(private Eloquentity $eloquentity)
    {
    }

    /**
     * @throws EloquentityException
     * @throws ReflectionException
     */
    public function get(string $id): ProductEntity
    {
        return $this->eloquentity->map(ProductEloquentModel::query()->findOrFail($id), ProductEntity::class);
    }

    /**
     * @throws ReflectionException
     */
    public function store(ProductEntity $product): void
    {
        $this->eloquentity->persist($product, ProductEloquentModel::class);
    }
}
