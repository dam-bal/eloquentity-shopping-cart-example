<?php

namespace App\Providers;

use Core\Shared\Application\CommandBusInterface;
use Core\Shared\Infrastructure\IlluminateSyncCommandBus;
use Illuminate\Support\ServiceProvider;

class CommandBusProvider extends ServiceProvider
{
    private const COMMAND_HANDLERS_MAP = [];

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

        $commandBus->register(self::COMMAND_HANDLERS_MAP);
    }
}
