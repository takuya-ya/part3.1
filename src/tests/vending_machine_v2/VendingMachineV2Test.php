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

        // 投入金額が100円未満の場合、コーラは購入できない
        $vendingMachine->depositCoin(0);
        $this->assertSame('お金が足りません', $vendingMachine->pressButton($item));

        // 投入金額が100円の場合、コーラが購入できる
        $vendingMachine->depositCoin(100);
        $this->assertSame('cola', $vendingMachine->pressButton($item));


    }
}
