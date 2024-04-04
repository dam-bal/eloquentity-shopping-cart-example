<?php

namespace App\Repositories;

use App\Entities\Cart as CartEntity;
use App\Models\Cart as CartEloquentModel;
use App\Repositories\Interfaces\CartRepository;
use Eloquentity\Eloquentity;

final readonly class EloquentCartRepository implements CartRepository
{
    public function __construct(private Eloquentity $eloquentity)
    {
    }

    public function get(string $id): CartEntity
    {
        return $this->eloquentity->map(CartEloquentModel::query()->findOrFail($id), CartEntity::class);
    }

    public function store(CartEntity $cart): void
    {
        $this->eloquentity->persist($cart, CartEloquentModel::class);
    }
}
