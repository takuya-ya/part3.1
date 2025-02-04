<?php

namespace BlackJack;

use BlackJack\Dealer;
use BlackJack\Deck;

class Player
{
    public array $hand = [];
    public function __construct(
        public Dealer $dealer,
        public Deck $deck,
        public string $playerName
        )
    {
    }

    public function getHand(): array
    {
        return $this->dealer->dealStartHands($this->deck);
    }

    public function addCard(Dealer $dealer, Deck $deck, array $playerHand): array
    {
        $playerHand = array_merge($playerHand, $dealer->dealAddCard($deck));
        return $playerHand;
    }
}
