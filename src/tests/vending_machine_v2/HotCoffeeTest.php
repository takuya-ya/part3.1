<?php

namespace VendingMachineV2Tests;

use PHPUnit\Framework\TestCase;
use VendingMachineV2\HotCoffee;

class HotCoffeeTest extends TestCase
{
    public function testGetName()
    {
        $hotCoffee = new HotCoffee();
        $this->assertSame('hot Coffee', $hotCoffee->getName());
    }

    public function testGetPrice()
    {
        $hotCoffee = new HotCoffee();
        $this->assertSame(150, $hotCoffee->getPrice());
    }

    public function testGetCup()
    {
        $hotCoffee = new HotCoffee();
        $this->assertSame(1, $hotCoffee->getCup());
    }
}
