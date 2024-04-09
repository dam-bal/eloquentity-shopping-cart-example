<?php

namespace Tests\Unit\Core\Shared\Infrastructure;

use Core\Shared\Application\Query;
use Core\Shared\Infrastructure\IlluminateQueryBus;
use Illuminate\Bus\Dispatcher;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class IlluminateQueryBusTest extends TestCase
{
    private Dispatcher|MockObject $dispatcherMock;

    private IlluminateQueryBus $sut;

    protected function setUp(): void
    {
        $this->dispatcherMock = $this->createMock(Dispatcher::class);

        $this->sut = new IlluminateQueryBus($this->dispatcherMock);
    }

    public function testQueryCallsDispatchWithNowWithQueryAndReturnsResult(): void
    {
        $query = $this->createMock(Query::class);

        $this->dispatcherMock
            ->expects($this->once())
            ->method('dispatchNow')
            ->with($query)
            ->willReturn('result');

        $this->assertEquals('result', $this->sut->query($query));
    }

    public function testRegisterCallsMap(): void
    {
        $this->dispatcherMock
            ->expects($this->once())
            ->method('map')
            ->with(
                [
                    'a' => 'b'
                ]
            );

        $this->sut->register(
            [
                'a' => 'b'
            ]
        );
    }
}
