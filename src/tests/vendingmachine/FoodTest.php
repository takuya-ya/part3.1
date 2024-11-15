<?php

namespace VendingMachineTests;

use PHPUnit\Framework\TestCase;
use VendingMachine\Food;

class FoodTest extends TestCase
{
    public function testGetName()
    {
        $item = new Food('potato chips');
        $this->assertSame('potato chips', $item->getName());
    }

    public function testGetPrice()
    {
        $item = new Food('potato chips');
        $this->assertSame(150, $item->getPrice());
    }
}
