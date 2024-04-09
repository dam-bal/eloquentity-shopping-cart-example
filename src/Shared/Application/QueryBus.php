<?php

namespace Core\Shared\Application;

interface QueryBus
{
    /**
     * @template T of mixed
     * @param Query<T> $query
     * @return T
     */
    public function query(Query $query);

    /**
     * @param array<class-string, class-string> $map
     * @return void
     */
    public function register(array $map): void;
}
