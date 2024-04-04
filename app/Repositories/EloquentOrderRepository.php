<?php

namespace App\Repositories;

use App\Entities\Order as OrderEntity;
use App\Models\Order as OrderEloquentModel;
use App\Repositories\Interfaces\OrderRepository;
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
