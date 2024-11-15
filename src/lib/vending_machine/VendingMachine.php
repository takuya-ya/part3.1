<?php

namespace VendingMachine;

use VendingMachine\Item;

class VendingMachine
{
    private const MAX_CUP_NUMBER = 100;
    private int $depositedCoin = 0;
    private int $addedCup = 0;

    public function depositCoin(int $insertedCoin): int
    {
        if ($insertedCoin === 100) {
            $this->depositedCoin += $insertedCoin;
        }
        return $this->depositedCoin;
    }

    public function addCup(int $refillCup): int
    {
        $this->addedCup += $refillCup;
        if ($this->addedCup > self::MAX_CUP_NUMBER) {
            $this->addedCup = self::MAX_CUP_NUMBER;
        }
        return $this->addedCup;
    }

    // Itemインスタンス管理、インスタンスに名前と金額を出させている
    public function pressButton(Item $item): string
    {
        $price = $item->getPrice();
        $cup = $item->getCupNumber();

        if (($this->depositedCoin) >= $price && ($this->addedCup) >= $cup) {
            $this->depositedCoin -= $price;
            $this->addedCup -= $cup;
            return $item->getName();
        }
        return '';
    }

    public function returnDeposit() {

    }

}
