<?php

namespace App\Providers;

use App\IdInterface;
use App\Repositories\EloquentCartRepository;
use App\Repositories\Interfaces\CartRepository;
use App\Repositories\Interfaces\OrderRepository;
use App\Repositories\Interfaces\ProductRepository;
use App\Repositories\EloquentOrderRepository;
use App\RamseyUuid;
use App\Repositories\EloquentProductRepository;
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

        $this->app->bind(OrderRepository::class, EloquentOrderRepository::class);
        $this->app->bind(CartRepository::class, EloquentCartRepository::class);
        $this->app->bind(ProductRepository::class, EloquentProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
