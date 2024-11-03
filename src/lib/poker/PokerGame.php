<?php

class PokerGame
{
    function __construct(private array $card1, private array $card2)
    {
    }

    public function start(): array
    {
        return [$this->card1, $this->card2];
    }
}
// $game = new PokerGame(['CA', 'DA'], ['C10', 'H10']);
// var_dump($game->start());
