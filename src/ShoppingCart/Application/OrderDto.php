<?php

namespace Core\ShoppingCart\Application;

use Core\ShoppingCart\Domain\Order;
use Core\ShoppingCart\Domain\OrderLine;
use Core\ShoppingCart\Domain\Shipment;
use DateTime;
use JsonSerializable;

readonly final class OrderDto implements JsonSerializable
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

    public static function createFromOrderDomainObject(Order $order): self
    {
        return new self(
            $order->customerId,
            $order->getStatus()->value,
            $order->getPrice(),
            $order->getShipment(),
            $order->getPaymentMethod()->value,
            array_map(
                static fn(OrderLine $orderLine): OrderLineDto => OrderLineDto::createFromOrderLineDomainObject($orderLine),
                $order->getLines()
            ),
            $order->getPlacedDate()
        );
    }

    public function jsonSerialize(): mixed
    {
        return [
            'status' => $this->status,
            'lines' => $this->lines,
            'customer_id' => $this->customerId,
            'price' => $this->price,
            'shipment' => [
                'city' => $this->shipment->city,
                'street_name' => $this->shipment->streetName,
                'street_number' => $this->shipment->streetNumber,
                'receiver_full_name' => $this->shipment->receiverFullName,
            ],
            'payment_method' => $this->paymentMethod,
            'placed_date' => $this->placedDate->format('Y-m-d H:i:s'),
        ];
    }
}
