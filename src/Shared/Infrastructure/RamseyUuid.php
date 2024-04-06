<?php

namespace Core\Shared\Infrastructure;

use Core\Shared\Domain\IdInterface;
use Ramsey\Uuid\Uuid;

final class RamseyUuid implements IdInterface
{
    public function getId(): string
    {
        return Uuid::uuid4()->toString();
    }
}
