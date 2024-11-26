<?php

namespace VendingMachineV2;

use VendingMachineV2\CupCoffee;

class IceCoffee extends CupCoffee
{
    protected array $item =
    [
        'name' => 'iceCoffee',
        'price' => 150,
        'cupCount' => 1
    ];
}
