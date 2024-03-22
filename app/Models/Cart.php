<?php

namespace App\Models;

use App\Enums\PaymentMethod;
use App\ValueObjects\Shipment;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory, HasUuids;

    protected $casts = [
        'payment_method' => PaymentMethod::class,
        'shipment'       => Shipment::class,
    ];

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class, 'cart_id', 'id');
    }
}
