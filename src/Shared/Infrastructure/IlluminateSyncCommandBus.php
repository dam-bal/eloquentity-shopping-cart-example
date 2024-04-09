<?php

namespace Core\Shared\Infrastructure;

use Core\Shared\Application\CommandBus;
use Core\Shared\Application\Command;
use Illuminate\Bus\Dispatcher;

final readonly class IlluminateSyncCommandBus implements CommandBus
{
    public function __construct(private Dispatcher $dispatcher)
    {
    }

    public function dispatch(Command $command): void
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
