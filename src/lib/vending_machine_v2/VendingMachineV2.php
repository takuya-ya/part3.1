<?php

namespace VendingMachineV2;

use VendingMachineV2\CoinManager;
use VendingMachineV2\Item;
use VendingMachineV2\InstanceFactory;
use VendingMachineV2\InventoryManager;

class VendingMachineV2
{
    private const ITEM_CONSUMPTION_ITEM = 1;

    private InstanceFactory $instanceFactory;
    private CoinManager $coinManager;
    private InventoryManager $inventoryManager;

    public function __construct() {
        $this->instanceFactory = new InstanceFactory();
        $this->coinManager = new CoinManager();
        $this->inventoryManager = new InventoryManager();
    }

    // インスタンス作成を担うクラス
    public function instanceFactory(string $name): Item {
        return $this->instanceFactory->selectItem($name);
    }

    public function depositCoin(int $coin): int
    {
        return $this->coinManager->depositCoin($coin);
    }

    public function replenishItem(int $count): bool {
            return $this->inventoryManager->addStock($count);
    }
    // １がマジックナンバー。ドリンク購入時に消費する在庫数。定数を設定する
    public function pressButton(Item $item): string
    {
        if ($this->coinManager->useCoin($item) && $this->inventoryManager->useItem(self::ITEM_CONSUMPTION_ITEM)) {
            return $item->getName();
        }
        return '';
    }
}
