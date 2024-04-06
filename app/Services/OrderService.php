<?php

namespace App\Services;

use App\Entities\Order;
use App\Enums\PaymentMethod;
use App\IdInterface;
use App\Repositories\Interfaces\CartRepository;
use App\Repositories\Interfaces\OrderRepository;
use App\ValueObjects\Shipment;
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
