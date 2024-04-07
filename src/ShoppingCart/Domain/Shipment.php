<?php

namespace Core\ShoppingCart\Domain;

use InvalidArgumentException;
use JsonSerializable;

readonly class Shipment implements JsonSerializable
{
    public function __construct(
        public string $city,
        public string $streetName,
        public string $streetNumber,
        public string $receiverFullName
    ) {
        if (empty($this->city)) {
            throw new InvalidArgumentException("city is required");
        }

        if (empty($this->streetName)) {
            throw new InvalidArgumentException("streetName is required");
        }

        if (empty($this->streetNumber)) {
            throw new InvalidArgumentException("streetNumber is required");
        }

        if (empty($this->receiverFullName)) {
            throw new InvalidArgumentException("receiverFullName is required");
        }

        $names = explode(' ', $this->receiverFullName);
        if (count($names) <= 1) {
            throw new InvalidArgumentException('receiverFullName needs first name and last name');
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
