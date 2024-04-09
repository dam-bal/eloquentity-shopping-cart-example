<?php

namespace Core\Shared\Application;

interface CommandBus
{
    public function dispatch(Command $command): void;

    /**
     * @param array<class-string, class-string> $map
     */
    public function register(array $map): void;
}
