<?php

namespace VendingMachineV2;

use VendingMachineV2\Item;

class Cola implements Item
{
    private array $item =
    [
        'name' => 'cola',
        'price' => 100
    ];

    public function getName()
    {
        return self::$item['name'];
    }

    public function getPrice()
    {
        return self::$item['price'];
    }
}
