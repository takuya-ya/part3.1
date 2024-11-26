<?php

namespace VendingMachineV2;

use VendingMachineV2\Item;

abstract class CupCoffee extends Item
{
    public function getCup(): int {
        return $this->item['cupCount'];
    }
}
