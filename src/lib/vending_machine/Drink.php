<?php

namespace VendingMachine;

class Drink extends Item
{
    private const PRICES = [
        'cider' => 100,
        'cola' => 150
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

    // 補充する数量をアイテム毎に加算
    public function replenishNumber($replenishNum)
    {
        $this->replenishedNum += $replenishNum;
        if ($this->replenishedNum > self::MAX_ITEM_NUM) {
            $this->replenishedNum = self::MAX_ITEM_NUM ;
        }
        return $this->replenishedNum;
    }
}
