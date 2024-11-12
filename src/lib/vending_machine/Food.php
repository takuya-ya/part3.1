<?php

namespace VendingMachine;

require_once 'Item.php';

class Food extends Item
{
    private const PRICES = [
        'potato chips' => 150,
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
}