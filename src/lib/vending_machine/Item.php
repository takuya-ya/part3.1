<?php

namespace VendingMachine;

abstract class Item
{
    abstract public function getPrice();
    abstract public function getCupNumber();
    abstract public function replenishNumber(int $replenishNum);
    abstract public function getReplenishedNumber();


    public function __construct(public string $name)
    {
    }

    public function getName()
    {
        return $this->name;
    }
}
