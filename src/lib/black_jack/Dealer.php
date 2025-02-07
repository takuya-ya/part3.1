<?php

namespace BlackJack;

use BlackJack\Deck;

class Dealer
{
    private const FIRST_CARD_NUMBER = 2;
    private const ADD_CARD_NUMBER = 1;

    public array $dealerCard = [];
    public function __construct (private Deck $deck)
    {
    }

    public function dealStartHands(): array
    {
        return $this->deck->drawCard(self::FIRST_CARD_NUMBER);
    }
    // TODO dealStartHands（）に統一かのうでは？
    // public function makeDealerHand(Deck $deck): array
    // {
    //     $dealerHand = $deck->drawCard(self::FIRST_CARD_NUMBER);
    //     return $dealerHand;
    // }

    public function dealAddCard(): array
    {
        return $this->deck->drawCard(self::ADD_CARD_NUMBER);
    }
}
