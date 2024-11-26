<?php

namespace VendingMachineV2;

use VendingMachineV2\CupCoffee;

class HotCoffee extends CupCoffee
{
    protected array $item =
    [
        'name' => 'hotCoffee',
        'price' => 150,
        'cupCount' => 1
    ];
}
