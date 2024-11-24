<?php

namespace VendingMachineV2;

use VendingMachineV2\Item;

class InventoryManager
{
    // これは０で良いのか？クラス生成の度に０になってしまう
    // いずれは複数アイテムの在庫管理が必要になるので別の方法が必要
    private int $replenishedItem = 0;

    public function addStock(int $count): int
    {
        return $this->replenishedItem += $count;
    }

    public function useItem($count): bool
    {
        return $this->replenishedItem >= $count;
    }
}
