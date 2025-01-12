<?php

namespace BlackJack;

use BlackJack\Card;

require_once(__DIR__.'/Card.php');

class Deck
{
    public array $cardDeck = [];
    public array $drawnCard = [];

    public function __construct(public Card $card)
    {
        shuffle($this->card->cards);
        $this->cardDeck = $this->card->cards;
    }

    public function drawCard(int $drawCardNum) : array
    {
        // 山札からカードを取得し、取得したカードは山札から削除
        $this->drawnCard = array_splice($this->cardDeck, 0, $drawCardNum);
        return $this->drawnCard;
    }

    public function startHands(array $playerNames) : array
    {
        $playerHands = [];
        foreach($playerNames as $playerName) {
            $this->drawCard(2);
            $playerHands[$playerName] = $this->drawnCard;
        }
        return $playerHands;
    }
}
