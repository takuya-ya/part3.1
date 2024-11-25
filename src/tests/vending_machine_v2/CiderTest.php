<?php

namespace VendingMachineV2Tests;

use PHPUnit\Framework\TestCase;
use VendingMachineV2\Cider;

class CiderTest extends TestCase
{
    public function testGetName()
    {
        $cola = new Cider();
        $this->assertSame('cider', $cola->getName());
    }

    public function testGetPrice()
    {
        $cola = new Cider();
        $this->assertSame(100, $cola->getPrice());
    }
}
