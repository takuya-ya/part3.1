<?php

namespace VendingMachineV2;

use VendingMachineV2\CoinManager;
use VendingMachineV2\Item;
use VendingMachineV2\InstanceFactory;
use VendingMachineV2\InventoryManager;
use VendingMachineV2\CupManager;

class VendingMachineV2
{
    private const ITEM_CONSUMPTION_ITEM = 1;

    private InstanceFactory $instanceFactory;
    private CoinManager $coinManager;
    private InventoryManager $inventoryManager;
    private CupManager $cupManager;

    public function __construct() {
        $this->instanceFactory = new InstanceFactory();
        $this->coinManager = new CoinManager();
        $this->inventoryManager = new InventoryManager();
        $this->cupManager = new CupManager();
    }

    // インスタンス作成を担うクラス
    public function instanceFactory(string $name): Item {
        return $this->instanceFactory->selectItem($name);
    }

    public function depositCoin(int $coin): int
    {
        return $this->coinManager->depositCoin($coin);
    }

    // 補充を行うクラス
    public function replenishItem(int $itemCount): bool {
            return $this->inventoryManager->addStock($itemCount);
    }

    public function addCups(int $cupCount): int {
            return $this->cupManager->addCup($cupCount);
    }

    public function pressButton(Item $item): string
    {
        if (
            $this->coinManager->useCoin($item)
            && $this->inventoryManager->useItem(self::ITEM_CONSUMPTION_ITEM)
            && $this->cupManager->useCup($item)
                    ) {
            return $item->getName();
        }
        return '';
    }
}
