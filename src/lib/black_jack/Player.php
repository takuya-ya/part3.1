<?php

namespace BlackJack;

use BlackJack\Dealer;
use BlackJack\Deck;

require_once(__DIR__.'/Dealer.php');
require_once(__DIR__.'/Deck.php');

class Player
{
    public array $hand = [];

    public function __construct(public string $playerName)
    {
    }

    public function addCard(Dealer $dealer, Deck $deck, array $playerHand): array
    {
        $playerHand[] = $dealer->dealAddCard($deck);
        return $playerHand;
    }
}
