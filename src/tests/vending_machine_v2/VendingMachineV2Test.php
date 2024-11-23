<?php

namespace VendingMachineV2Tests;

use PHPUnit\Framework\TestCase;
use VendingMachineV2\CoinManager;
use VendingMachineV2\VendingMachineV2;
use VendingMachineV2\Cola;

class VendingMachineV2Test extends TestCase{

    public function testPressButton()
    {
        $vendingMachine = new VendingMachineV2;
        $item = new Cola;
        $vendingMachine->depositCoin(100);
        $this->assertSame('cola', $vendingMachine->pressButton($item));
    }
}
