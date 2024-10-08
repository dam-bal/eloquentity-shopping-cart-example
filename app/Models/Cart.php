<?php

namespace App\Models;

use App\Casts\Shipment;
use Core\ShoppingCart\Domain\PaymentMethod;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory, HasUuids;

    /**
     * @return array<string, mixed>
     */
    protected function casts(): array
    {
        return [
            'payment_method' => PaymentMethod::class,
            'shipment' => Shipment::class,
        ];
    }

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }
}
