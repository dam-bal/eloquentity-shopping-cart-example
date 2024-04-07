<?php

namespace Core\ShoppingCart\Infrastructure;

use App\Models\Order as OrderEloquentModel;
use Core\ShoppingCart\Domain\Order as OrderEntity;
use Core\ShoppingCart\Domain\OrderRepository;
use Eloquentity\Eloquentity;
use Eloquentity\Exception\EloquentityException;
use ReflectionException;

final readonly class EloquentOrderRepository implements OrderRepository
{
    public function __construct(private Eloquentity $eloquentity)
    {
    }

    /**
     * @throws EloquentityException
     * @throws ReflectionException
     */
    public function get(string $id): OrderEntity
    {
        return $this->eloquentity->map(OrderEloquentModel::query()->findOrFail($id), OrderEntity::class);
    }

    /**
     * @throws ReflectionException
     */
    public function store(OrderEntity $order): void
    {
        $this->eloquentity->persist($order, OrderEloquentModel::class);
    }
}
