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

        return new JsonResponse($this->orderRepository->get($orderId));
    }
}
