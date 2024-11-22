<?php

namespace VendingMachineV2Tests;

use PHPUnit\Framework\TestCase;
use VendingMachineV2\CoinManager;

class CoinManagerTest extends TestCase
{
    public function testDepositCoin()
    {
        $coinManager = new CoinManager();
        $this->assertSame(100, $coinManager->depositCoin(100));
    }
}
