<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartCheckoutRequest;
use App\Http\Requests\StoreCartRequest;
use App\Models\Cart;
use App\Repositories\Interfaces\CartRepository;
use App\Repositories\Interfaces\ProductRepository;
use App\Services\CartService;
use App\Services\OrderService;
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

    public function store(StoreCartRequest $request)
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


    public function show(string $cartId, Request $request)
    {
        if (!$request->user()->can('view', Cart::query()->findOrFail($cartId))) {
            abort(403);
        }

        return $this->cartRepository->get($cartId);
    }

    public function addProduct(string $cartId, string $productId, Request $request)
    {
        if (!$request->user()->can('update', Cart::query()->findOrFail($cartId))) {
            abort(403);
        }

        $cartEntity = $this->cartRepository->get($cartId);

        $productEntity = $this->productRepository->get($productId);

        $cartEntity->addProduct($productEntity);

        return new JsonResponse($cartEntity, Response::HTTP_CREATED);
    }

    public function removeProduct(string $cartId, string $productId, Request $request)
    {
        if (!$request->user()->can('update', Cart::query()->findOrFail($cartId))) {
            abort(403);
        }

        $cartEntity = $this->cartRepository->get($cartId);

        $productEntity = $this->productRepository->get($productId);

        $cartEntity->removeProduct($productEntity);

        return $cartEntity;
    }

    public function checkout(string $cartId, CartCheckoutRequest $request)
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