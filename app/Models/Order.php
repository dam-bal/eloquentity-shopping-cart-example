<?php

namespace App\Models;

use App\Casts\Shipment;
use Core\ShoppingCart\Domain\OrderStatus;
use Core\ShoppingCart\Domain\PaymentMethod;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory, HasUuids;

    /**
     * @return array<string, mixed>
     */
    protected function casts(): array
    {
        return [
            'status' => OrderStatus::class,
            'placed_date' => 'datetime',
            'shipment' => Shipment::class,
            'payment_method' => PaymentMethod::class,
        ];
    }

    public function lines(): HasMany
    {
        return $this->hasMany(OrderLine::class);
    }
}
