<?php

namespace App\Providers;

use Core\Shared\Application\CommandBus;
use Core\Shared\Infrastructure\IlluminateSyncCommandBus;
use Core\ShoppingCart\Application\AddProductToCartCommand;
use Core\ShoppingCart\Application\AddProductToCartCommandHandler;
use Core\ShoppingCart\Application\CreateCartForCustomerCommand;
use Core\ShoppingCart\Application\CreateCartForCustomerCommandHandler;
use Core\ShoppingCart\Application\CreateOrderFromCartCommand;
use Core\ShoppingCart\Application\CreateOrderFromCartCommandHandler;
use Core\ShoppingCart\Application\RemoveProductFromCartCommand;
use Core\ShoppingCart\Application\RemoveProductFromCartCommandHandler;
use Illuminate\Support\ServiceProvider;

class CommandBusProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->scoped(CommandBus::class, IlluminateSyncCommandBus::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        /** @var CommandBus $commandBus */
        $commandBus = app(CommandBus::class);

        $commandBus->register(
            [
                AddProductToCartCommand::class => AddProductToCartCommandHandler::class,
                RemoveProductFromCartCommand::class => RemoveProductFromCartCommandHandler::class,
                CreateCartForCustomerCommand::class => CreateCartForCustomerCommandHandler::class,
                CreateOrderFromCartCommand::class => CreateOrderFromCartCommandHandler::class,
            ]
        );
    }
}
