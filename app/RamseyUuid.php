<?php

namespace App;

use Ramsey\Uuid\Uuid;

final class RamseyUuid implements IdInterface
{
    public function getId(): string
    {
        return Uuid::uuid4()->toString();
    }
}
