<?php

namespace Tests\Unit\Core\ShoppingCart\Application;

use Core\ShoppingCart\Application\CreateCartForCustomerCommand;
use Core\ShoppingCart\Application\CreateCartForCustomerCommandHandler;
use Core\ShoppingCart\Domain\Cart;
use Core\ShoppingCart\Domain\CartRepository;
use PHPUnit\Framework\TestCase;

class CreateCartForCustomerCommandHandlerTest extends TestCase
{
    public function testItCreatesCartForCustomerAndStoresInRepository(): void
    {
        $cartRepository = $this->createMock(CartRepository::class);

        $cartRepository
            ->expects($this->once())
            ->method('store')
            ->with(new Cart('cartId', 'customerId'));

        $createCartForCustomerCommandHandler = new CreateCartForCustomerCommandHandler($cartRepository);

        $createCartForCustomerCommandHandler(new CreateCartForCustomerCommand('cartId', 'customerId'));
    }
}
