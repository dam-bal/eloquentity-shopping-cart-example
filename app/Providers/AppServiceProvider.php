<?php

namespace App\Providers;

use Core\Shared\Domain\IdInterface;
use Core\Shared\Infrastructure\RamseyUuid;
use Core\ShoppingCart\Domain\CartRepository;
use Core\ShoppingCart\Domain\OrderRepository;
use Core\ShoppingCart\Domain\ProductRepository;
use Core\ShoppingCart\Infrastructure\EloquentCartRepository;
use Core\ShoppingCart\Infrastructure\EloquentOrderRepository;
use Core\ShoppingCart\Infrastructure\EloquentProductRepository;
use Eloquentity\Eloquentity;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->scoped(Eloquentity::class, static fn(): Eloquentity => Eloquentity::create());

        $this->app->singleton(IdInterface::class, RamseyUuid::class);
        $this->app->singleton(OrderRepository::class, EloquentOrderRepository::class);
        $this->app->singleton(CartRepository::class, EloquentCartRepository::class);
        $this->app->singleton(ProductRepository::class, EloquentProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
