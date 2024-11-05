<?php

require_once 'Item.php';

class CupDrink extends Item
{
    private const PRICES_CUPS = [
        'hot cup coffee' => ['price' => 100, 'cup' => 1 ],
        'ice cup coffee' => ['price' => 100, 'cup' => 1 ],
    ];

    function __construct(private string $name)
    {
        parent::__construct($name);
    }

    public function getPrice()
    {
        return $this::PRICES_CUPS[$this->name]['price'];
    }

    public function getCupNumber()
    {
        return $this::PRICES_CUPS[$this->name]['cup'];
    }
}
