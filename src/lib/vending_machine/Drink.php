<?php

require_once 'Item.php';

class drink extends Item
{
    private const PRICES_CUPS = [
        'cider' => ['price' => 100, 'cup' => 0],
        'cola' => ['price' => 150, 'cup' => 0]
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
