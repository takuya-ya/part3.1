<?php

namespace BlackJack;

class Game
{
    public function __construct(public string $playerName)
    {
    }

    public function start()
    {
        return $this->playerName;
    }
}
