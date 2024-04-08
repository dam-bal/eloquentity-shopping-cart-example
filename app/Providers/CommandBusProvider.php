<?php

namespace App\Providers;

use Core\Shared\Application\CommandBusInterface;
use Core\Shared\Infrastructure\IlluminateSyncCommandBus;
use Core\ShoppingCart\Application\AddProductToCartCommand;
use Core\ShoppingCart\Application\AddProductToCartCommandHandler;
use Core\ShoppingCart\Application\CreateCartForCustomerCommand;
use Core\ShoppingCart\Application\CreateCartForCustomerCommandHandler;
use Core\ShoppingCart\Application\RemoveProductFromCart;
use Core\ShoppingCart\Application\RemoveProductFromCartCommandHandler;
use Illuminate\Support\ServiceProvider;

class CommandBusProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->scoped(CommandBusInterface::class, IlluminateSyncCommandBus::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        /** @var CommandBusInterface $commandBus */
        $commandBus = app(CommandBusInterface::class);

        $commandBus->register(
            [
                AddProductToCartCommand::class => AddProductToCartCommandHandler::class,
                RemoveProductFromCart::class => RemoveProductFromCartCommandHandler::class,
                CreateCartForCustomerCommand::class => CreateCartForCustomerCommandHandler::class,
            ]
        );
    }
}
