<?php

namespace VendingMachine;

use VendingMachine\Item;
use VendingMachine\Drink;

class VendingMachine
{
    private const MAX_CUP_NUMBER = 100;
    private int $depositedCoin = 0;
    private int $addedCup = 0;
    private int $replenishedNum = 0;

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

    public function replenishNumber(Item $item, int $replenishNum)
    {
        return $this-> replenishedNum = $item->replenishNumber($replenishNum);
    }

    // Itemインスタンス管理、インスタンスに名前と金額を出させている
    public function pressButton(Item $item): string
    {
        $price = $item->getPrice();
        $cup = $item->getCupNumber();
        $itemNum = $item->getReplenishedNumber();

        if (($this->depositedCoin) >= $price && ($this->addedCup) >= $cup && ($this->replenishedNum) >= $itemNum) {
            $this->depositedCoin -= $price;
            $this->addedCup -= $cup;
            $this->replenishedNum -= $itemNum;
            return $item->getName();
        }
        return '';
    }

    public function receiveChange()
    {
        $returnDeposit = $this->depositedCoin;
        $this->depositedCoin = 0;
        return $returnDeposit;
    }
}
