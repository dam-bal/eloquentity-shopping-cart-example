<?php

namespace App\ValueObjects;

readonly class Shipment
{
    public function __construct(
        public string $city,
        public string $streetName,
        public string $streetNumber,
        public string $receiverFullName
    )
    {
    }
}
