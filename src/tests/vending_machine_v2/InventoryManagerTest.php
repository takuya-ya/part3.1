<?php

namespace VendingMachineV2Tests;

use PHPUnit\Framework\TestCase;
use VendingMachineV2\InventoryManager;

class InventoryManagerTest extends TestCase
{
    public function testAddStock()
    {
        $inventoryManager = new InventoryManager();
        $this->assertSame(1, $inventoryManager->addStock(1));
    }

    public function testUseItem()
    {
        $inventoryManager = new InventoryManager();
        $this->assertSame(1, $inventoryManager->addStock(1));
    }
}
