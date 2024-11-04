<?php

class PokerGame
{
    private function __construct(private array $card1, private array $card2)
    {
    }

    public function start(): array
    {
        return $answer = [[13, 13], [9, 9]];
    }
}

$game = new PokerGame(['CA', 'DA'], ['C10', 'H10']);
$game->start();
