<?php

namespace VendingMachineV2;

use VendingMachineV2\Item;

class Cola extends Item
{
    protected array $item =
    [
        'name' => 'cola',
        'price' => 100,
        'cupCount' => 1
    ];
}
