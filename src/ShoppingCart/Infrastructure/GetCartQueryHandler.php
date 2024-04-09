<?php

namespace Core\ShoppingCart\Infrastructure;

use Core\ShoppingCart\Application\CartDto;
use Core\ShoppingCart\Application\GetCartQuery;
use Core\ShoppingCart\Domain\CartRepository;

readonly class GetCartQueryHandler
{
    public function __construct(
        private CartRepository $cartRepository
    ) {
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function __invoke(GetCartQuery $query): CartDto
    {
        return CartDto::createFromCartDomainObject($this->cartRepository->get($query->cartId));
    }
}
