<?php

class VendingMachine
{
    private const PRICE_OF_DRINK = 100;
    private int $depositedCoin = 0;

    function depositCoin(int $insertedCoin): int
    {
        if ($insertedCoin === 100) {
            $this->depositedCoin += $insertedCoin;
        }
        return $this->depositedCoin;

    }

    function pressButton(): string
    {
        if (($this->depositedCoin) >= $this::PRICE_OF_DRINK) {
            $this->depositedCoin -= $this::PRICE_OF_DRINK;
            return 'cider';
        }
        return '';
    }
}
