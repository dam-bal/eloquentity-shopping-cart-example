<?php

namespace App\Requests;

use Core\ShoppingCart\Domain\PaymentMethod;
use Core\ShoppingCart\Domain\Shipment;

readonly class CheckoutRequest
{
    public function __construct(
        public PaymentMethod $paymentMethod,
        public Shipment $shipment
    ) {
    }
}
