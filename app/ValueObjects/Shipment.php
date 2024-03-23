<?php

namespace App\ValueObjects;

readonly class Shipment implements \JsonSerializable
{
    public function __construct(
        public string $city,
        public string $streetName,
        public string $streetNumber,
        public string $receiverFullName
    )
    {
        // @TODO validation
    }

    public function jsonSerialize(): mixed
    {
        return [
            'city' => $this->city,
            'streetName' => $this->streetName,
            'streetNumber' => $this->streetNumber,
            'receiverFullName' => $this->receiverFullName,
        ];
    }
}
