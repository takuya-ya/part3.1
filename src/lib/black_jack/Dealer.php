<?php

namespace BlackJack;

use BlackJack\Deck;

class Dealer
{
    private const FIRST_CARD_NUMBER = 2;
    private const ADD_CARD_NUMBER = 1;

    public array $dealerCard = [];

    public function dealStartHands(Deck $deck, array $playerNames): array
    {
        $playerHands = $deck->startHands($playerNames);
        return $playerHands;
    }

    public function makeDealerHand(Deck $deck): array
    {
        $dealerHand = $deck->drawCard(self::FIRST_CARD_NUMBER);
        return $dealerHand;
    }

    public function dealAddCard(Deck $deck): array
    {
        $addedCard = $deck->drawCard(self::ADD_CARD_NUMBER);
        return $addedCard;
    }
}
