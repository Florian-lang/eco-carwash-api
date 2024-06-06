<?php

namespace App\Tests\Units;

use App\Entity\Price;
use App\Entity\WashStation;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class WashStationTest extends TestCase
{
    public function testSetName(): void
    {
        $washStation = new WashStation();
        $washStation->setName('Test Station');
        $this->assertSame('Test Station', $washStation->getName());
    }

    public function testSetAddress(): void
    {
        $washStation = new WashStation();
        $washStation->setAddress('Test Address');
        $this->assertSame('Test Address', $washStation->getAddress());
    }

    public function testSetLongitude(): void
    {
        $washStation = new WashStation();
        $washStation->setLongitude(10.5);
        $this->assertSame(10.5, $washStation->getLongitude());
    }

    public function testSetLatitude(): void
    {
        $washStation = new WashStation();
        $washStation->setLatitude(20.5);
        $this->assertSame(20.5, $washStation->getLatitude());
    }

    /**
     * @throws Exception
     */
    public function testAddPrice(): void
    {
        $washStation = new WashStation();
        $price = $this->createMock(Price::class);
        $washStation->addPrice($price);
        $this->assertCount(1, $washStation->getPrices());
    }

    /**
     * @throws Exception
     */
    public function testRemovePrice(): void
    {
        $washStation = new WashStation();
        $price = $this->createMock(Price::class);
        $washStation->addPrice($price);
        $washStation->removePrice($price);
        $this->assertCount(0, $washStation->getPrices());
    }
}