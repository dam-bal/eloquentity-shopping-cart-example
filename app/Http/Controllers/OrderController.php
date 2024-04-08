<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Core\ShoppingCart\Application\OrderService as ApplicationOrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(private readonly ApplicationOrderService $orderService)
    {
    }

    public function show(string $orderId, Request $request): JsonResponse
    {
        if (!$request->user()->can('view', Order::query()->findOrFail($orderId))) {
            abort(403);
        }

        return new JsonResponse($this->orderService->getOrderDto($orderId));
    }
}
