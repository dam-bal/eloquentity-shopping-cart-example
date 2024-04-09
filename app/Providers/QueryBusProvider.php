<?php

namespace App\Providers;

use Core\Shared\Application\QueryBus;
use Core\Shared\Infrastructure\IlluminateQueryBus;
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
    }
}
