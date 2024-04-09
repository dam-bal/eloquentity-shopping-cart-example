<?php

namespace Core\ShoppingCart\Application;

use Core\ShoppingCart\Domain\CartRepository;
use Core\ShoppingCart\Domain\ProductRepository;

readonly class RemoveProductFromCartCommandHandler
{
    public function __construct(
        private CartRepository $cartRepository,
        private ProductRepository $productRepository
    ) {
    }

    public function __invoke(RemoveProductFromCartCommand $command): void
    {
        $product = $this->productRepository->get($command->productId);
        $cart = $this->cartRepository->get($command->cartId);

        $cart->removeProduct($product);
    }
}
