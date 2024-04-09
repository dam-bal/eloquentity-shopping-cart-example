<?php

namespace Tests\Unit\Core\Shared\Infrastructure;

use Core\Shared\Application\Command;
use Core\Shared\Infrastructure\IlluminateSyncCommandBus;
use Illuminate\Bus\Dispatcher;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class IlluminateSyncCommandBusTest extends TestCase
{
    private Dispatcher|MockObject $dispatcherMock;

    private IlluminateSyncCommandBus $sut;

    protected function setUp(): void
    {
        $this->dispatcherMock = $this->createMock(Dispatcher::class);

        $this->sut = new IlluminateSyncCommandBus($this->dispatcherMock);
    }

    public function testDispatchCallsDispatchNowWithCommand(): void
    {
        $command = $this->createMock(Command::class);

        $this->dispatcherMock
            ->expects($this->once())
            ->method('dispatchNow')
            ->with($command)
            ->willReturn('result');

        $this->sut->dispatch($command);
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
