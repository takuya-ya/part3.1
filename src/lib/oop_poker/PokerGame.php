<?php

require_once 'ConvertToNumber.php';

class PokerGame
{

    public function __construct(private array $card1, private array $card2)
    {
    }

    public function start(): array
    {
        $playerCards = [$this->card1, $this->card2];
        foreach ($playerCards as $playerCard) {
            $ranks = new ConvertToNumber($playerCard);
            $handRanks = $ranks->convertToNum();
        }
        return [$handRanks[0], $handRanks[1]];
    }
}
// $game = new PokerGame(['CA', 'DA'], ['C10', 'H10']);
// var_dump($game->start());
