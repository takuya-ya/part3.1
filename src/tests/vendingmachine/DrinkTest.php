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

    public function testReplenishNumber()
    {
        $item = new Drink('cola');
        $replenishNum = 0;
        $this->assertSame(0, $item->replenishNumber($replenishNum));
        $replenishNum = 50;
        $this->assertSame(50, $item->replenishNumber($replenishNum));
    }
}
