<?php

namespace VendingMachineV2;

class CoinManager
{
    private int $depositedCoin = 0;

    public function depositCoin(int $coin): int
    {
        if ($coin = 100) {
        return $this->depositedCoin += $coin;
        }
    }

    public function useCoin(): bool
    {
        return true;
    }
}
