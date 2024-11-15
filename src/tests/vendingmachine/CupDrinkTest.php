<?php

namespace VendingMachineTests;

use PHPUnit\Framework\TestCase;
use VendingMachine\CupDrink;

class CupDrinkTest extends TestCase
{
    public function testGetName()
    {
        $item = new CupDrink('hot cup coffee');
        $this->assertSame('hot cup coffee', $item->getName());
    }

    public function testGetPrice()
    {
        $item = new CupDrink('ice cup coffee');
        $this->assertSame(100, $item->getPrice());
    }

    public function testGetCup()
    {
        $item = new CupDrink('ice cup coffee');
        $this->assertSame(1, $item->getCupNumber());
    }
}
