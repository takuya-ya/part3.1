<?php

namespace VendingMachineV2Tests;

use PHPUnit\Framework\TestCase;
use VendingMachineV2\VendingMachineV2;


class VendingMachineV2Test extends TestCase{

    public function testPressButton()
    {
        $vendingMachine = new VendingMachineV2;
        $this->assertSame('cola', $vendingMachine->pressButton('cola'));
    }
}
