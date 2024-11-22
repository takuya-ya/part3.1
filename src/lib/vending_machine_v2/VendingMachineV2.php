<?php

namespace VendingMachineV2;

class VendingMachineV2 {
    private CoinManager $coinManager;

    public function __construct() {
        $this->coinManager = new CoinManager;
    }

    public function depositCoin(int $coin): int
    {
        return $this->coinManager->depositCoin($coin);
    }

    public function pressButton(string $item): string
    {
        if ($this->coinManager->useCoin()) {
            return "cola";
        }
    }
}
