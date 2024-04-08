<?php

namespace Core\Shared\Infrastructure;

use Core\Shared\Application\CommandBusInterface;
use Core\Shared\Application\CommandInterface;
use Illuminate\Bus\Dispatcher;

final readonly class IlluminateSyncCommandBus implements CommandBusInterface
{
    public function __construct(private Dispatcher $dispatcher)
    {
    }

    public function dispatch(CommandInterface $command): void
    {
        $this->dispatcher->dispatchNow($command);
    }

    /**
     * @param array<class-string, class-string> $map
     */
    public function register(array $map): void
    {
        $this->dispatcher->map($map);
    }
}
