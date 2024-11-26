<?php

namespace VendingMachineV2;

use VendingMachineV2\CupCoffee;

class IceCoffee extends CupCoffee
{
    protected array $item =
    [
        'name' => 'ice coffee',
        'price' => 150,
        'cupCount' => 1
    ];
}
