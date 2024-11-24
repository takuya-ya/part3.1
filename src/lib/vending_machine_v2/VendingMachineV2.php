<?php

namespace VendingMachineV2;

use VendingMachineV2\CoinManager;
use VendingMachineV2\Item;
use VendingMachineV2\InstanceFactory;
use VendingMachineV2\InventoryManager;

// 在庫管理のクラス

class VendingMachineV2 {
    private InstanceFactory $instanceFactory;
    private CoinManager $coinManager;
    private InventoryManager $inventoryManager;

    public function __construct() {
        $this->coinManager = new CoinManager;
        $this->instanceFactory = new InstanceFactory;
        $this->inventoryManager = new InventoryManager;
    }

    // インスタンス作成を担うクラス
    public function instanceFactory(string $name): Item {
        return $item = $this->instanceFactory->selectItem($name);
    }

    public function depositCoin(int $coin): int
    {
        return $this->coinManager->depositCoin($coin);
    }

    public function replenishItem(int $count): bool {
            return $this->inventoryManager->addStock($count);
    }

    public function pressButton(Item $item): string
    {
        if ($this->coinManager->useCoin($item) && $this->inventoryManager->useItem(1)) {
            return "cola";
        }
        return 'お金が足りません';
    }
}
