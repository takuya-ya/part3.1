<?php

namespace VendingMachineV2;

use VendingMachineV2\CupCoffee;

class HotCoffee extends CupCoffee
{
    protected array $item =
    [
        'name' => 'hot Coffee',
        'price' => 150,
        'cupCount' => 1
    ];
}
