<?php

namespace Tests\Unit\Core\ShoppingCart\Domain;

use Core\ShoppingCart\Domain\Shipment;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ShipmentTest extends TestCase
{
    public function testItThrowsExceptionWhenCityIsEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $sut = new Shipment(
            '',
            'streetName',
            'streetNumber',
            'firstName lastName'
        );
    }

    public function testItThrowsExceptionWhenStreetNameIsEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $sut = new Shipment(
            'city',
            '',
            'streetNumber',
            'firstName lastName'
        );
    }

    public function testItThrowsExceptionWhenStreetNumberIsEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $sut = new Shipment(
            'city',
            'streetName',
            '',
            'firstName lastName'
        );
    }

    public function testItThrowsExceptionWhenReceiverFullNameHasOneName(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $sut = new Shipment(
            'city',
            'streetName',
            'streetNumber',
            'firstName'
        );
    }

    public function testValid(): void
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
