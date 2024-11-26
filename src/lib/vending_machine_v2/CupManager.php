<?php

namespace VendingMachineV2;

use VendingMachineV2\Item;

class CupManager
{
    public int $addedCup = 0;

    public function addCup(int $cupsToAdd): int
    {
        return $this->addedCup += $cupsToAdd;
    }

    public function useCup(Item $item): bool
    {
        return $this->addedCup >= $item->getCup();
    }
}
