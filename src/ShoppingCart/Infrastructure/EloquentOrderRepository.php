<?php

namespace Core\ShoppingCart\Infrastructure;

use App\Models\Order as OrderEloquentModel;
use Core\ShoppingCart\Domain\Order as OrderEntity;
use Core\ShoppingCart\Domain\OrderRepository;
use Eloquentity\Eloquentity;
use Eloquentity\Exception\EloquentityException;
use Illuminate\Database\Eloquent\Model;
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
        /** @var Model $model */
        $model = OrderEloquentModel::query()->findOrFail($id);

        return $this->eloquentity->map($model, OrderEntity::class);
    }

    /**
     * @throws ReflectionException
     */
    public function store(OrderEntity $order): void
    {
        $this->eloquentity->persist($order, OrderEloquentModel::class);
    }
}
