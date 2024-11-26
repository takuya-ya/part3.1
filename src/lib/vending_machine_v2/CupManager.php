<?php

namespace VendingMachineV2;

class CupManager
{
    private int $addedCup = 0;

    public function addCup(int $cupsToAdd): int
    {
        return $this->addedCup += $cupsToAdd;
    }

    public function useCup($cupsToUse): bool
    {
        return $this->addedCup >= $cupsToUse;
    }
}
