<?php

namespace Core\ShoppingCart\Domain;

use RuntimeException;

class OrderService
{
    public function createOrderFromCart(
        string $orderId,
        Cart $cart,
        Shipment $shipment,
        PaymentMethod $paymentMethod
    ): Order {
        if ($cart->isCompleted()) {
            throw new RuntimeException("Cart already completed");
        }

        if ($cart->isEmpty()) {
            throw new RuntimeException("Cart is empty");
        }

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

        $order = new Order(
            $orderId,
            $cart->customerId,
            $shipment,
            $paymentMethod,
            $orderLines
        );

        $cart->markAsCompleted();

        return $order;
    }
}
