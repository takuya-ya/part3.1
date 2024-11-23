<?php

namespace VendingMachineV2;

class CoinManager
{
    private int $depositedCoin = 0;

    public function depositCoin(int $coin): int
    {
        if ($coin === 100) {
            $this->depositedCoin += $coin;
        }
        return $this->depositedCoin;
    }

    public function useCoin(): bool
    {
        return true;
    }
}
