<?php

namespace Tests\Unit\Core\ShoppingCart\Domain;

use Core\ShoppingCart\Domain\Shipment;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ShipmentTest extends TestCase
{
    public function test_it_throws_exception_when_city_is_empty(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $sut = new Shipment(
            '',
            'streetName',
            'streetNumber',
            'firstName lastName'
        );
    }

    public function test_it_throws_exception_when_streetName_is_empty(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $sut = new Shipment(
            'city',
            '',
            'streetNumber',
            'firstName lastName'
        );
    }

    public function test_it_throws_exception_when_streetNumber_is_empty(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $sut = new Shipment(
            'city',
            'streetName',
            '',
            'firstName lastName'
        );
    }

    public function test_it_throws_exception_when_receiverFullName_has_one_name(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $sut = new Shipment(
            'city',
            'streetName',
            'streetNumber',
            'firstName'
        );
    }

    public function test_valid(): void
    {
        $sut = new Shipment(
            'city',
            'streetName',
            'streetNumber',
            'firstName lastName'
        );

        $this->assertEquals('city', $sut->city);
        $this->assertEquals('streetName', $sut->streetName);
        $this->assertEquals('streetNumber', $sut->streetNumber);
        $this->assertEquals('firstName lastName', $sut->receiverFullName);
    }
}
