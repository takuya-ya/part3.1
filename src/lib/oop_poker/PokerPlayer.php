<?php

class PokerPlayer
{
    public function __construct(private array $cardNumbers)
    {
    }

    public function getCardRank(): array
    {
        return array_map(fn($cardNumber) => $card->getRank(), $this->cardNumbers);
        // return $cardRanks = [[10, 10], [1, 1]];
    }
}
