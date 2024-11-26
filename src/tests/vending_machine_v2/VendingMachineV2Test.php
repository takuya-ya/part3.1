<?php

namespace VendingMachineV2Tests;

use PHPUnit\Framework\TestCase;
use VendingMachineV2\VendingMachineV2;
use VendingMachineV2\Cola;

class VendingMachineV2Test extends TestCase{

    public function testPressButton()
    {
        $vendingMachine = new VendingMachineV2;
        $item = new Cola;

        $this->assertEquals(new Cola, $vendingMachine->instanceFactory('cola'));

        // 投入金額が100円未満の場合、コーラは購入できない
        $vendingMachine->depositCoin(0);
        $this->assertSame('', $vendingMachine->pressButton($item));

        // 投入金額が100円の場合、コーラが購入できる
        $vendingMachine->depositCoin(100);
        $vendingMachine->replenishItem(10);
        $vendingMachine->addCups(10);
        $this->assertSame('cola', $vendingMachine->pressButton($item));


    }
}
