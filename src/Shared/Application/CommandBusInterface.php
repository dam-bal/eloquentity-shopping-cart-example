<?php

namespace Core\Shared\Application;

interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): void;

    /**
     * @param array<class-string, class-string> $map
     */
    public function register(array $map): void;
}
