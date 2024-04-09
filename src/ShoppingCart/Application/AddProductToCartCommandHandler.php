<?php

namespace Core\ShoppingCart\Application;

use Core\ShoppingCart\Domain\CartRepository;
use Core\ShoppingCart\Domain\ProductRepository;

final readonly class AddProductToCartCommandHandler
{
    public function __construct(
        private CartRepository $cartRepository,
        private ProductRepository $productRepository
    ) {
    }

    public function __invoke(AddProductToCartCommand $command): void
    {
        $product = $this->productRepository->get($command->productId);
        $cart = $this->cartRepository->get($command->cartId);

        $cart->addProduct($product);
    }
}
