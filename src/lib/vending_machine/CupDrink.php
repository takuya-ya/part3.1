<?php

namespace VendingMachine;

use VendingMachine\Item;

class CupDrink extends Item
{
    private const PRICES = [
        'hot cup coffee' => 100,
        'ice cup coffee' => 100
    ];

    public function __construct(string $name)
    {
        parent::__construct($name);
    }

    public function getPrice()
    {
        return self::PRICES[$this->name];
    }

    public function getCupNumber()
    {
        return 1;
    }

    public function replenishNumber($replenishNum)
    {
        return 0;
    }
}
