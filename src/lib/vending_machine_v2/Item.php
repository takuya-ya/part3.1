<?php

namespace VendingMachineV2;

abstract class Item
{
    protected array $item;

    public function getName()
    {
        return $this->item['name'];
    }

    public function getPrice()
    {
        return $this->item['price'];
    }
}
