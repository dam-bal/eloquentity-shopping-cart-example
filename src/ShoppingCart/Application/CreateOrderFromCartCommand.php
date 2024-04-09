<?php

namespace Core\ShoppingCart\Application;

use Core\Shared\Application\Command;
use Core\ShoppingCart\Domain\PaymentMethod;
use Core\ShoppingCart\Domain\Shipment;

readonly class CreateOrderFromCartCommand implements Command
{
    public function __construct(
        public string $orderId,
        public string $cartId,
        public Shipment $shipment,
        public PaymentMethod $paymentMethod
    ) {
    }
}
