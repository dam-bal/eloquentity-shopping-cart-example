<?php

namespace Core\ShoppingCart\Domain;

use Core\Shared\Domain\Entity;
use DateTime;

class Order extends Entity
{
    private OrderStatus $status = OrderStatus::PLACED;

    /**
     * @param OrderLine[] $lines
     */
    public function __construct(
        string $id,
        public readonly string $customerId,
        private readonly Shipment $shipment,
        private readonly PaymentMethod $paymentMethod,
        private readonly array $lines = [],
        private readonly DateTime $placedDate = new DateTime()
    ) {
        $this->setId($id);
    }

    public function getShipment(): Shipment
    {
        return $this->shipment;
    }

    public function getPaymentMethod(): PaymentMethod
    {
        return $this->paymentMethod;
    }

    /**
     * @return OrderLine[]
     */
    public function getLines(): array
    {
        return $this->lines;
    }

    public function getPlacedDate(): DateTime
    {
        return $this->placedDate;
    }

    public function getStatus(): OrderStatus
    {
        return $this->status;
    }

    public function getPrice(): float
    {
        return array_reduce(
            $this->lines,
            static fn(float $carry, OrderLine $line): float => $carry + $line->getTotalPrice(),
            0.0
        );
    }
}
