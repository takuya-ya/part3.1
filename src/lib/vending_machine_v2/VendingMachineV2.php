<?php

namespace VendingMachineV2;

use VendingMachineV2\CoinManager;
use VendingMachineV2\Item;

class VendingMachineV2 {
    private CoinManager $coinManager;

    public function __construct() {
        $this->coinManager = new CoinManager;
    }

    public function depositCoin(int $coin): int
    {
        return $this->coinManager->depositCoin($coin);
    }

    public function pressButton(Item $item): string
    {
        if ($this->coinManager->useCoin($item)) {
            return "cola";
        }
        return 'お金が足りません';
    }
}
