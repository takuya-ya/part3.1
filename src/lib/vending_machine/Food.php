<?php

namespace VendingMachine;

use VendingMachine\Item;

class Food extends Item
{
    private const PRICES = [
        'potato chips' => 150,
    ];
    private $replenishedNum;
    private const MAX_ITEM_NUM = 50;

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

    public function getReplenishedNumber()
    {
        return 1;
    }


    public function replenishNumber(int $replenishNum)
    {
        $this->replenishedNum += $replenishNum;
        if ($this->replenishedNum > self::MAX_ITEM_NUM) {
            $this->replenishedNum = self::MAX_ITEM_NUM ;
        }
        return $this->replenishedNum;
    }
}
