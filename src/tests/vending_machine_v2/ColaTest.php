<?php

namespace VendingMachineV2Tests;

use PHPUnit\Framework\TestCase;
use VendingMachineV2\Cola;

class ColaTest extends TestCase
{
    public function testGetName()
    {
        $cola = new Cola();
        $this->assertSame('cola', $cola->getName());
    }
}
