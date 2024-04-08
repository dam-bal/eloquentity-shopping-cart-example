<?php

namespace Core\Shared\Application;

interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): void;

    public function register(array $map): void;
}
