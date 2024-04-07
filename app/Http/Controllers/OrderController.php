<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Core\ShoppingCart\Domain\OrderRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(private readonly OrderRepository $orderRepository)
    {
    }

    public function show(string $orderId, Request $request): JsonResponse
    {
        if (!$request->user()->can('view', Order::query()->findOrFail($orderId))) {
            abort(403);
        }

        $order = $this->orderRepository->get($orderId);

        $lines = [];
        foreach ($order->getLines() as $orderLine) {
            $lines[] = [
                'name' => $orderLine->name,
                'sku' => $orderLine->sku,
                'unit_price' => $orderLine->unitPrice,
                'quantity' => $orderLine->quantity,
                'price' => $orderLine->getTotalPrice(),
            ];
        }

        $orderShipment = $order->getShipment();

        $shipment = [
            'city' => $orderShipment->city,
            'street_name' => $orderShipment->streetName,
            'street_number' => $orderShipment->streetNumber,
            'receiver_full_name' => $orderShipment->receiverFullName,
        ];

        return new JsonResponse(
            [
                'status' => $order->getStatus(),
                'lines' => $lines,
                'customer_id' => $order->customerId,
                'price' => $order->getPrice(),
                'shipment' => $shipment,
                'payment_method' => $order->getPaymentMethod(),
                'placed_date' => $order->getPlacedDate()->format('Y-m-d H:i:s'),
            ]
        );
    }
}
