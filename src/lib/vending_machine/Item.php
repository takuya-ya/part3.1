<?php

namespace VendingMachine;

abstract class Item
{
    abstract public function getPrice();
    abstract public function getCupNumber();
    abstract public function replenishNumber($replenishNum);

    public function __construct(public string $name)
    {
    }

    public function getName()
    {
        return $this->name;
    }
}
