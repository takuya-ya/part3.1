<?php

namespace VendingMachineV2Tests;

use PHPUnit\Framework\TestCase;
use VendingMachineV2\IceCoffee;

class IceCoffeeTest extends TestCase
{
    public function testGetName()
    {
        $iceCoffee = new IceCoffee();
        $this->assertSame('ice coffee', $iceCoffee->getName());
    }

    public function testGetPrice()
    {
        $iceCoffee = new IceCoffee();
        $this->assertSame(150, $iceCoffee->getPrice());
    }

    public function testGetCup()
    {
        $iceCoffee = new IceCoffee();
        $this->assertSame(1, $iceCoffee->getCup());
    }
}
