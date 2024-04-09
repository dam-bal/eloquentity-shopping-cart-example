<?php

namespace App\Providers;

use Core\Shared\Application\QueryBus;
use Core\Shared\Infrastructure\IlluminateQueryBus;
use Core\ShoppingCart\Application\GetCartQuery;
use Core\ShoppingCart\Application\GetOrderQuery;
use Core\ShoppingCart\Infrastructure\GetOrderQueryHandler;
use Core\ShoppingCart\Infrastructure\GetCartQueryHandler;
use Illuminate\Support\ServiceProvider;

class QueryBusProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->scoped(QueryBus::class, IlluminateQueryBus::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        /** @var QueryBus $queryBus */
        $queryBus = app(QueryBus::class);

        $queryBus->register(
            [
                GetOrderQuery::class => GetOrderQueryHandler::class,
                GetCartQuery::class => GetCartQueryHandler::class,
            ]
        );
    }
}
