<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartCheckoutRequest;
use App\Models\Cart;
use Core\ShoppingCart\Domain\CartRepository;
use Core\ShoppingCart\Domain\CartService;
use Core\ShoppingCart\Domain\OrderService;
use Core\ShoppingCart\Domain\ProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartController extends Controller
{
    public function __construct(
        private readonly CartRepository    $cartRepository,
        private readonly ProductRepository $productRepository,
        private readonly OrderService      $orderService,
        private readonly CartService       $cartService
    )
    {
    }

    public function store(Request $request): JsonResponse
    {
        if (!$request->user()->can('create', Cart::class)) {
            abort(403);
        }

        $cartEntity = $this->cartService->createCart($request->user()->customer->id);

        return new JsonResponse(
            [
                'cartId' => $cartEntity->getId(),
            ],
            Response::HTTP_CREATED
        );
    }


    public function show(string $cartId, Request $request): JsonResponse
    {
        if (!$request->user()->can('view', Cart::query()->findOrFail($cartId))) {
            abort(403);
        }

        return new JsonResponse($this->cartRepository->get($cartId));
    }

    public function addProduct(string $cartId, string $productId, Request $request): JsonResponse
    {
        if (!$request->user()->can('update', Cart::query()->findOrFail($cartId))) {
            abort(403);
        }

        $cartEntity = $this->cartRepository->get($cartId);

        $productEntity = $this->productRepository->get($productId);

        $cartEntity->addProduct($productEntity);

        return new JsonResponse($cartEntity, Response::HTTP_CREATED);
    }

    public function removeProduct(string $cartId, string $productId, Request $request): JsonResponse
    {
        if (!$request->user()->can('update', Cart::query()->findOrFail($cartId))) {
            abort(403);
        }

        $cartEntity = $this->cartRepository->get($cartId);

        $productEntity = $this->productRepository->get($productId);

        $cartEntity->removeProduct($productEntity);

        return new JsonResponse($cartEntity);
    }

    public function checkout(string $cartId, CartCheckoutRequest $request): JsonResponse
    {
        if (!$request->user()->can('update', Cart::query()->findOrFail($cartId))) {
            abort(403);
        }

        $order = $this->orderService->createOrderFromCart($cartId, $request->shipment(), $request->paymentMethod());

        return new JsonResponse(
            [
                'orderId' => $order->getId(),
                'order' => $order,
            ],
            Response::HTTP_CREATED
        );
    }
}
