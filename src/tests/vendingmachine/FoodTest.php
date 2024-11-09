<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../lib/vending_machine/Food.php';

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
