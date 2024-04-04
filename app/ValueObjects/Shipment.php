<?php

namespace App\ValueObjects;

use InvalidArgumentException;

readonly class Shipment implements \JsonSerializable
{
    public function __construct(
        public string $city,
        public string $streetName,
        public string $streetNumber,
        public string $receiverFullName
    )
    {
        if (empty($this->city) ||
            empty($this->streetName) ||
            empty($this->streetNumber) ||
            empty($this->receiverFullName)
        ) {
            throw new InvalidArgumentException();
        }

        $names = explode(' ', $this->receiverFullName);
        if (count($names) <= 1) {
            throw new InvalidArgumentException();
        }
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
