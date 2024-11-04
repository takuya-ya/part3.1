<?php

require_once('PokerCard.php');

class PokerPlayer
{
    // [[10,10],[11,11]]
    public function __construct(private array $cardNumbers)
    {
    }

    // PokerCardのgetRank関数を使用、数字をランクに変換
    public function getCardRank(): array
    {
        $card = new PokerCard($this->cardNumbers);
        return $card->getRank();
        // return $cardRanks = [[10, 10], [1, 1]];
    }
}
