<?php

namespace Core\ShoppingCart\Domain;

use Carbon\Carbon;
use DateTime;
use JsonSerializable;
use RuntimeException;

class Order extends Entity implements JsonSerializable
{
    private OrderStatus $status = OrderStatus::PLACED;

    /**
     * @param OrderLine[] $lines
     */
    public function __construct(
        string                         $id,
        public readonly string         $customerId,
        private readonly Shipment      $shipment,
        private readonly PaymentMethod $paymentMethod,
        private readonly array         $lines = [],
        private readonly DateTime      $placedDate = new DateTime()
    )
    {
        $this->setId($id);
    }

    public function getPrice(): float
    {
        return array_reduce(
            $this->lines,
            static fn(float $carry, OrderLine $line): float => $carry + $line->getTotalPrice(),
            0.0
        );
    }

    public static function createFromCart(
        string        $id,
        Cart          $cart,
        Shipment      $shipment,
        PaymentMethod $paymentMethod
    ): Order
    {
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
            $cart->getCustomerId(),
            $shipment,
            $paymentMethod,
            $orderLines,
            Carbon::now()
        );
    }

    public function jsonSerialize(): mixed
    {
        return [
            'status' => $this->status,
            'lines' => $this->lines,
            'customerId' => $this->customerId,
            'price' => $this->getPrice(),
            'shipment' => $this->shipment,
            'paymentMethod' => $this->paymentMethod,
            'placedDate' => $this->placedDate->format('Y-m-d H:i:s'),
        ];
    }
}
