<?php

namespace BlackJac\Player;

class Player
{
    public function __construct(public string $playerName)
    {
    }
    public function receiveCard(array $playerCards)
    {
        return  $playerCards[$this->playerName];
    }
}
