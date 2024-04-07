<?php

namespace Core\ShoppingCart\Domain;

use Carbon\Carbon;
use DateTime;
use RuntimeException;

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

    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    public function getShipment(): Shipment
    {
        return $this->shipment;
    }

    public function getPaymentMethod(): PaymentMethod
    {
        return $this->paymentMethod;
    }

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

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public static function createFromCart(
        string $id,
        Cart $cart,
        Shipment $shipment,
        PaymentMethod $paymentMethod
    ): Order {
        $orderLines = [];

        foreach ($cart->getItems() as $item) {
            if (!$item->getQuantity()) {
                continue;
            }

            $orderLines[] = new OrderLine(
                $item->getProduct()->name,
                $item->getProduct()->sku,
                $item->getProduct()->price,
                $item->getQuantity()
            );
        }

        if (empty($orderLines)) {
            throw new RuntimeException("Can't create order that has no order lines!");
        }

        return new Order(
            $id,
            $cart->customerId,
            $shipment,
            $paymentMethod,
            $orderLines,
            Carbon::now()
        );
    }
}
