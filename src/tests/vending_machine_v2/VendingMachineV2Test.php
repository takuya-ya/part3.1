<?php

namespace VendingMachineV2Tests;

use PHPUnit\Framework\TestCase;
use VendingMachineV2\VendingMachineV2;
use VendingMachineV2\Cola;
use VendingMachineV2\HotCoffee;

class VendingMachineV2Test extends TestCase{

    public function testPressButton()
    {
        $vendingMachine = new VendingMachineV2;
        $item = new Cola;

        // 投入金額が100円未満の場合、コーラは購入できない
        $vendingMachine->depositCoin(0);
        $this->assertSame('', $vendingMachine->pressButton($item));

        // 在庫不足の場合、コーラは購入できない
        $vendingMachine->depositCoin(100);
        $vendingMachine->replenishItem(0);
        $this->assertSame('', $vendingMachine->pressButton($item));

        // カップ不足の場合、コーラは購入できない
        $vendingMachine->replenishItem(10);
        $vendingMachine->addCups(0);
        $this->assertSame('', $vendingMachine->pressButton($item));

        // 購入条件を満たした場合、コーラが購入できる
        $vendingMachine->addCups(10);
        $this->assertSame('cola', $vendingMachine->pressButton($item));

        // 購入条件を満たした場合、ホットコーヒーが購入できる（コーラよりも50円高い）
        $item = new HotCoffee;
        $vendingMachine->depositCoin(0);
        $this->assertSame('', $vendingMachine->pressButton($item));
        $vendingMachine->depositCoin(100);
        $vendingMachine->depositCoin(100);
        $vendingMachine->replenishItem(10);
        $vendingMachine->addCups(10);
        $this->assertSame('hot coffee', $vendingMachine->pressButton($item));

    }
}
