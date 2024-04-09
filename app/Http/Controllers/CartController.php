<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartCheckoutRequest;
use App\Models\Cart;
use Core\Shared\Application\CommandBus;
use Core\Shared\Application\IdProvider;
use Core\Shared\Application\QueryBus;
use Core\ShoppingCart\Application\AddProductToCartCommand;
use Core\ShoppingCart\Application\CreateCartForCustomerCommand;
use Core\ShoppingCart\Application\CreateOrderFromCartCommand;
use Core\ShoppingCart\Application\GetCartQuery;
use Core\ShoppingCart\Application\RemoveProductFromCart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartController extends Controller
{
    public function __construct(
        private readonly CommandBus $commandBus,
        private readonly QueryBus $queryBus,
        private readonly IdProvider $idProvider
    ) {
    }

    public function store(Request $request): JsonResponse
    {
        if (!$request->user()->can('create', Cart::class)) {
            abort(403);
        }

        $cartId = $this->idProvider->getId();

        $this->commandBus->dispatch(new CreateCartForCustomerCommand($cartId, $request->user()->customer->id));

        return new JsonResponse(
            [
                'cart_id' => $cartId,
            ],
            Response::HTTP_CREATED
        );
    }


    public function show(string $cartId, Request $request): JsonResponse
    {
        if (!$request->user()->can('view', Cart::query()->findOrFail($cartId))) {
            abort(403);
        }

        return new JsonResponse($this->queryBus->query(new GetCartQuery($cartId)));
    }

    public function addProduct(string $cartId, string $productId, Request $request): JsonResponse
    {
        if (!$request->user()->can('update', Cart::query()->findOrFail($cartId))) {
            abort(403);
        }

        $this->commandBus->dispatch(new AddProductToCartCommand($productId, $cartId));

        return new JsonResponse(null, Response::HTTP_CREATED);
    }

    public function removeProduct(string $cartId, string $productId, Request $request): JsonResponse
    {
        if (!$request->user()->can('update', Cart::query()->findOrFail($cartId))) {
            abort(403);
        }

        $this->commandBus->dispatch(new RemoveProductFromCart($productId, $cartId));

        return new JsonResponse(null);
    }

    public function checkout(string $cartId, CartCheckoutRequest $request): JsonResponse
    {
        if (!$request->user()->can('update', Cart::query()->findOrFail($cartId))) {
            abort(403);
        }

        $orderId = $this->idProvider->getId();

        $this->commandBus->dispatch(
            new CreateOrderFromCartCommand(
                $orderId,
                $cartId,
                $request->shipment(),
                $request->paymentMethod()
            )
        );

        return new JsonResponse(
            [
                'order_id' => $orderId,
            ],
            Response::HTTP_CREATED
        );
    }
}
