<?php

namespace BlackJack;

use BlackJack\Dealer;

require_once(__DIR__.'/Dealer.php');

class Game
{
    public function __construct(public string $playerName)
    {
    }

    public function start()
    {
        $dealer = new Dealer;
        $playersCards = $dealer->dealingCard($this->playerName);
        return $playersCards;
    }
}
