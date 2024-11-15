<?php

namespace VendingMachineTests;

use PHPUnit\Framework\TestCase;
use VendingMachine\Drink;

class DrinkTest extends TestCase
{
    public function testGetName()
    {
        $item = new Drink('cider');
        $this->assertSame('cider', $item->getName());
    }

    public function testGetPrice()
    {
        $item = new Drink('cola');
        $this->assertSame(150, $item->getPrice());
    }
}
