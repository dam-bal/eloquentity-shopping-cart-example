<?php

namespace Tests\Unit\Core\Shared\Infrastructure;

use Core\Shared\Infrastructure\RamseyUuid;
use Tests\TestCase;

class RamseyUuidTest extends TestCase
{
    private RamseyUuid $sut;

    protected function setUp(): void
    {
        $this->sut = new RamseyUuid();
    }

    public function testGetId(): void
    {
        self::assertNotEmpty($this->sut->getId());
    }
}
