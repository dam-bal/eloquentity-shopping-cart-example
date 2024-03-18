<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory, HasUuids;

    protected $casts = [
        'status' => OrderStatus::class,
        'placed_date' => 'datetime'
    ];

    public function orderLines(): HasMany
    {
        return $this->hasMany(OrderLine::class, 'order_id', 'id');
    }
}
