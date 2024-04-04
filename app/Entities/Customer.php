<?php

namespace App\Entities;

class Customer extends Entity
{
    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName
    )
    {
    }
}
