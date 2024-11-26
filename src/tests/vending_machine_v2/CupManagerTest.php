<?php

namespace VendingMachineV2Tests;

use PHPUnit\Framework\TestCase;
use VendingMachineV2\CupManager;
use VendingMachineV2\Cola;

class CupManagerTest extends TestCase
{
    public function testAddStock()
    {
        $cupManager = new CupManager;
        $this->assertSame(1, $cupManager->addCup(1));
    }

    public function testUseCup()
    {
        $cola = new Cola;
        $cupManager = new CupManager;
        // カップが補充されてない場合は失敗する
        $cupManager->addCup(0);
        $this->assertSame(false, $cupManager->useCup($cola));
        // カップが補充されている場合は成功する
        $cupManager->addCup(1);
        $this->assertSame(true, $cupManager->useCup($cola));
    }
}
