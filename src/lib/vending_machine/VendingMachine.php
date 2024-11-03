<?php

require_once __DIR__ . '/../../lib/vending_machine/Item.php';


class VendingMachine
{
    private int $depositedCoin = 0;

    public function depositCoin(int $insertedCoin): int
    {
        if ($insertedCoin === 100) {
            $this->depositedCoin += $insertedCoin;
        }
        return $this->depositedCoin;
    }

    public function pressButton(Item $item): string
    {
        $price = $item->getPrice();
        if (($this->depositedCoin) >= $price) {
            $this->depositedCoin -= $price;
            return $item->getName();
        }
        return '';
    }
}
