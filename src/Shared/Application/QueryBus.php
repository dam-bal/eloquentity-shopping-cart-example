<?php

namespace Core\Shared\Application;

interface QueryBus
{
    /**
     * @template T
     * @param Query<T> $message
     * @return T
     */
    public function handle(Query $message): object;

    /**
     * @param array<class-string, class-string> $map
     * @return void
     */
    public function register(array $map): void;
}
