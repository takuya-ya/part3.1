<?php

class Item
{
    private const PRICES = [
        'cider' => 100,
        'cola' => 150
    ];

    function __construct(private string $name)
    {
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this::PRICES[$this->name];
    }
}
