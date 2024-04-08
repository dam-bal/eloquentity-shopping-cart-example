<?php

namespace Core\ShoppingCart\Domain;

use RuntimeException;

readonly class OrderService
{
    public function __construct(
        private CartRepository $cartRepository,
        private OrderRepository $orderRepository,
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
            throw new RuntimeException();
        }

        if (empty($cart->getItems())) {
            throw new RuntimeException();
        }

        $order = Order::createFromCart($orderId, $cart, $shipment, $paymentMethod);

        $this->orderRepository->store($order);

        $cart->markAsCompleted();

        return $order;
    }
}
