<?php

namespace BlackJack;

class Player
{
    public array $hand = [];

    public function __construct(public string $playerName)
    {
    }

    public function receiveCard(array $playerCards): array
    {
        $this->hand = $playerCards[$this->playerName];
        return $this->hand;
    }

    public function additionalDrawCard(array $playerCards, int $cardNumber): array{
        $dealer = new Dealer;
        $dealer->drawCards();
        return $playerCards;
    }
}
