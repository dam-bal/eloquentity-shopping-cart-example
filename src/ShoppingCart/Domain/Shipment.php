<?php

namespace Core\ShoppingCart\Domain;

use InvalidArgumentException;

class Shipment
{
    public function __construct(
        public readonly string $city,
        public readonly string $streetName,
        public readonly string $streetNumber,
        public readonly string $receiverFullName
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
}
