<?php

namespace Core\ShoppingCart\Application;

use Core\ShoppingCart\Domain\Order;
use Core\ShoppingCart\Domain\OrderLine;
use Core\ShoppingCart\Domain\Shipment;
use DateTime;

final readonly class OrderDto
{
    /**
     * @param OrderLineDto[] $lines
     */
    public function __construct(
        public string $customerId,
        public string $status,
        public float $price,
        public Shipment $shipment,
        public string $paymentMethod,
        public array $lines,
        public DateTime $placedDate
    ) {
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public static function createFromOrderDomainObject(Order $order): self
    {
        return new self(
            $order->customerId,
            $order->getStatus()->value,
            $order->getPrice(),
            $order->getShipment(),
            $order->getPaymentMethod()->value,
            array_map(
                fn(OrderLine $orderLine): OrderLineDto => OrderLineDto::createFromOrderLineDomainObject($orderLine),
                $order->getLines()
            ),
            $order->getPlacedDate()
        );
    }
}
