<?php

namespace App\Requests;

readonly class StoreCustomerRequest
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $password
    ) {
    }
}
