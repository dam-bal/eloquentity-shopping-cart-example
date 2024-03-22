<?php

namespace App\Casts;

use App\ValueObjects\Shipment as ShipmentValueObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class Shipment implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return new ShipmentValueObject('city', 'streetName', 'streetNumber', 'test');
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return [
            'shipment_city' => $value->city,
            'shipment_street_name' => $value->streetName,
            'shipment_street_number' => $value->streetNumber,
            'shipment_receiver_full_name' => $value->receiverFullName,
        ];
    }
}
