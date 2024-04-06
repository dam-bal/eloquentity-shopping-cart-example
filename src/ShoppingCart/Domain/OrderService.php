<?php

namespace Core\ShoppingCart\Domain;

use Core\Shared\Domain\IdInterface;
use RuntimeException;

readonly class OrderService
{
    public function __construct(
        private CartRepository  $cartRepository,
        private OrderRepository $orderRepository,
        private IdInterface     $idProvider
    )
    {
    }

    public function createOrderFromCart(string $cartId, Shipment $shipment, PaymentMethod $paymentMethod): Order
    {
        $cart = $this->cartRepository->get($cartId);

        if ($cart->isCompleted()) {
            throw new RuntimeException();
        }

        if (empty($cart->getItems())) {
            throw new RuntimeException();
        }

        $order = Order::createFromCart($this->idProvider->getId(), $cart, $shipment, $paymentMethod);

        $this->orderRepository->store($order);

        $cart->markAsCompleted();

        return $order;
    }
}
