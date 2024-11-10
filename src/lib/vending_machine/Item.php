<?php

namespace VendingMachine;

abstract class Item
{
    abstract public function getPrice();
    abstract public function getCupNumber();

    public function __construct(public string $name)
    {
    }

    public function getName()
    {
        return $this->name;
    }
}
