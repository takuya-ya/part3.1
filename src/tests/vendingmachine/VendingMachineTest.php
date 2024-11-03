<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../lib/vending_machine/VendingMachine.php';

class VendingMachineTest extends TestCase
{
    public function testDepositCoin()
    {
        $vendingMachine = new vendingMachine;
        $this->assertSame(0, $vendingMachine->depositCoin(0));
        $this->assertSame(0, $vendingMachine->depositCoin(150));
        $this->assertSame(100, $vendingMachine->depositCoin(100));
    }

    public function testPressButton()
    {
        $cola = new Item('cola');
        $cider = new Item('cider');
        $vendingMachine = new VendingMachine;

        # お金が投入されてない場合は購入できない
        $this->assertSame('', $vendingMachine->pressButton($cider));

        // 100円を入れた場合はジュースを購入できる
        $vendingMachine->depositCoin(100);
        $this->assertSame('cider', $vendingMachine->pressButton($cider));
        // デポジット不足でコーラは買えない
        $vendingMachine->depositCoin(100);
        $this->assertSame('', $vendingMachine->pressButton($cola));
        // 繰り越しのデポジットと合わせてコーラを購入できる
        $vendingMachine->depositCoin(100);
        $this->assertSame('cola', $vendingMachine->pressButton($cola));
    }
}
