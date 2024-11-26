<?php

namespace VendingMachineV2;

use VendingMachineV2\Item;

class HotCoffee extends Item
{
    protected array $item =
    [
        'name' => 'hot coffee',
        'price' => 150,
        'cupCount' => 1
    ];
}
