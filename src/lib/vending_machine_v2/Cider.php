<?php

namespace VendingMachineV2;

use VendingMachineV2\Item;

class Cider extends Item
{
    protected array $item =
    [
        'name' => 'cider',
        'price' => 100,
        'cupCount' => 1
    ];
}
