<?php

namespace Core\Shared\Infrastructure;

use Core\Shared\Application\IdProvider;
use Ramsey\Uuid\Uuid;

final class RamseyUuid implements IdProvider
{
    public function getId(): string
    {
        return Uuid::uuid4()->toString();
    }
}
