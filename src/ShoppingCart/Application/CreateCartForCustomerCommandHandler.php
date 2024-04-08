<?php

namespace Core\ShoppingCart\Application;

use Core\ShoppingCart\Domain\Cart;
use Core\ShoppingCart\Domain\CartRepository;

readonly class CreateCartForCustomerCommandHandler
{
    public function __construct(
        private CartRepository $cartRepository
    ) {
    }

    public function __invoke(CreateCartForCustomerCommand $command): void
    {
        $cart = new Cart($command->cartId, $command->customerId);

        $this->cartRepository->store($cart);
    }
}
