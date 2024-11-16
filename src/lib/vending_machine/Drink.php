<?php

namespace VendingMachine;

class Drink extends Item
{
    private const PRICES = [
        'cider' => 100,
        'cola' => 150
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
        return 0;
    }

    public function replenishNumber($replenishNum)
    {
        return 0;
    }
}
