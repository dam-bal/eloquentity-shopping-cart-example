<?php

namespace Core\ShoppingCart\Domain;

use RuntimeException;

class OrderService
{
    public function __construct(
        private readonly CartRepository $cartRepository,
        private readonly OrderRepository $orderRepository,
    ) {
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function createOrderFromCart(
        string $orderId,
        string $cartId,
        Shipment $shipment,
        PaymentMethod $paymentMethod
    ): Order {
        $cart = $this->cartRepository->get($cartId);

        if ($cart->isCompleted()) {
            throw new RuntimeException('Cart already completed.');
        }

        if (empty($cart->getItems())) {
            throw new RuntimeException('Cart is empty.');
        }

        $order = Order::createFromCart($orderId, $cart, $shipment, $paymentMethod);

        $this->orderRepository->store($order);

        $cart->markAsCompleted();

        return $order;
    }
}
