<?php

namespace VendingMachineV2;

class InstanceFactory
{
    public function selectItem(string $name): Item
    {
        $item = match ($name) {
            'cola' => new Cola,
            'cider' => new Cider
        };
        return $item;
    }
}
