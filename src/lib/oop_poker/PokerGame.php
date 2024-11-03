<?php

require_once 'ConvertToNumber.php';

class PokerGame
{

    function __construct(private array $card1, private array $card2)
    {
    }

    public function start(): array
    {

        $ranks = new convertToNumber($this->card1, $this->card2);
        return [$ranks[0], $ranks[1]];
    }
}
// $game = new PokerGame(['CA', 'DA'], ['C10', 'H10']);
// var_dump($game->start());
