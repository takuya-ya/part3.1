<?php

namespace VendingMachineV2;

use VendingMachineV2\Item;

class IceCoffee extends Item
{
    protected array $item =
    [
        'name' => 'ice coffee',
        'price' => 150,
        'cupCount' => 1
    ];
}
