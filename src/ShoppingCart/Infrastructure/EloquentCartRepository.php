<?php

namespace Core\ShoppingCart\Infrastructure;

use App\Models\Cart as CartEloquentModel;
use Core\ShoppingCart\Domain\Cart as CartEntity;
use Core\ShoppingCart\Domain\CartRepository;
use Eloquentity\Eloquentity;
use Eloquentity\Exception\EloquentityException;
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
        return $this->eloquentity->map(CartEloquentModel::query()->findOrFail($id), CartEntity::class);
    }

    /**
     * @throws ReflectionException
     */
    public function store(CartEntity $cart): void
    {
        $this->eloquentity->persist($cart, CartEloquentModel::class);
    }
}
