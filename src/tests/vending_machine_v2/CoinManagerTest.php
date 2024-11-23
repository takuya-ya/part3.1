<?php

namespace VendingMachineV2Tests;

use PHPUnit\Framework\TestCase;
use VendingMachineV2\CoinManager;
use VendingMachineV2\Cola;

class CoinManagerTest extends TestCase
{
    public function testDepositCoin()
    {
        $coinManager = new CoinManager();
        // 投入金額が100円でない場合、投入金額が保持されない
        $this->assertSame(0, $coinManager->depositCoin(50));
        // 投入金額が100円の場合、投入金額が保持される
        $this->assertSame(100, $coinManager->depositCoin(100));
    }

    public function testUseCoin()
    {
        $coinManager = new CoinManager();
        // 投入金額が100円未満の場合、コーラは購入できない
        $coinManager->depositCoin(50);
        $this->assertSame(false, $coinManager->useCoin(new Cola));
        // 投入金額が100円の場合、コーラが購入できる
        $coinManager->depositCoin(100);
        $this->assertSame(true, $coinManager->useCoin(new Cola));
    }
}
