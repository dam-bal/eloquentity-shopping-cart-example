<?php

namespace Core\ShoppingCart\Application;

use Core\Shared\Application\CommandInterface;
use Core\ShoppingCart\Domain\PaymentMethod;
use Core\ShoppingCart\Domain\Shipment;

readonly class CreateOrderFromCartCommand implements CommandInterface
{
    public function __construct(
        public string $orderId,
        public string $cartId,
        public Shipment $shipment,
        public PaymentMethod $paymentMethod
    ) {
    }
}
