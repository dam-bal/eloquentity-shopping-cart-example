<?php

namespace Core\ShoppingCart\Infrastructure;

use App\Models\Order as OrderEloquentModel;
use Core\ShoppingCart\Domain\Order as OrderEntity;
use Core\ShoppingCart\Domain\OrderRepository;
use Eloquentity\Eloquentity;

final readonly class EloquentOrderRepository implements OrderRepository
{
    public function __construct(private Eloquentity $eloquentity)
    {
    }

    public function get(string $id): OrderEntity
    {
        return $this->eloquentity->map(OrderEloquentModel::query()->findOrFail($id), OrderEntity::class);
    }

    public function store(OrderEntity $order): void
    {
        $this->eloquentity->persist($order, OrderEloquentModel::class);
    }
}
