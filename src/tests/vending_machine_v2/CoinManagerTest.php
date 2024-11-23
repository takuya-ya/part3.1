<?php

namespace VendingMachineV2Tests;

use PHPUnit\Framework\TestCase;
use VendingMachineV2\CoinManager;

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
}
