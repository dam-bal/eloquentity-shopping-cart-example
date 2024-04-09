<?php

namespace Core\Shared\Infrastructure;

use Core\Shared\Application\Query;
use Core\Shared\Application\QueryBus;
use Illuminate\Bus\Dispatcher;

readonly class IlluminateQueryBus implements QueryBus
{
    public function __construct(private Dispatcher $dispatcher)
    {
    }

    /**
     * @inheritDoc
     */
    public function query(Query $message)
    {
        return $this->dispatcher->dispatchNow($message);
    }

    /**
     * @inheritDoc
     */
    public function register(array $map): void
    {
        $this->dispatcher->map($map);
    }
}
