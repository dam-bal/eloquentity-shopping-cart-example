<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Core\Shared\Application\QueryBus;
use Core\ShoppingCart\Application\GetOrderQuery;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\Serializer\Serializer;

class OrderController extends Controller
{
    public function __construct(
        private readonly QueryBus $queryBus,
        private readonly Serializer $serializer
    ) {
    }

    public function show(string $orderId, Request $request): JsonResponse
    {
        if (!$request->user()->can('view', Order::query()->findOrFail($orderId))) {
            abort(403);
        }

        return new JsonResponse(
            $this->serializer->normalize(
                $this->queryBus->query(new GetOrderQuery($orderId))
            )
        );
    }
}
