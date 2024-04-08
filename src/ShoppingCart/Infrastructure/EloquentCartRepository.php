<?php

namespace Core\ShoppingCart\Infrastructure;

use App\Models\Cart as CartEloquentModel;
use Core\ShoppingCart\Domain\Cart as CartEntity;
use Core\ShoppingCart\Domain\CartRepository;
use Eloquentity\Eloquentity;
use Eloquentity\Exception\EloquentityException;
use Illuminate\Database\Eloquent\Model;
use ReflectionException;

final readonly class EloquentCartRepository implements CartRepository
{
    public function __construct(private Eloquentity $eloquentity)
    {
    }

    /**
     * @throws EloquentityException
     * @throws ReflectionException
     */
    public function get(string $id): CartEntity
    {
        /** @var Model $model */
        $model = CartEloquentModel::query()->findOrFail($id);

        return $this->eloquentity->map($model, CartEntity::class);
    }

    /**
     * @throws ReflectionException
     */
    public function store(CartEntity $cart): void
    {
        $this->eloquentity->persist($cart, CartEloquentModel::class);
    }
}
