<?php

require_once 'PokerPlayer.php';

class PokerGame
{

    public function __construct(private array $card1, private array $card2)
    {
    }

    public function start(): array
    {
        // 修正：変数に代入せず、そのままforeachに渡すこと
        // $playerCards = [$this->card1, $this->card2];
        // foreach ($playerCards as $playerCard) {
        foreach ([$this->card1, $this->card2] as $playerCard) {
            $ranks = new PokerPlayer($playerCard);
            $handRanks[] = $ranks->convertToNum();
        }
        return $handRanks;
    }
}
// $game = new PokerGame(['CA', 'DA'], ['C10', 'H10']);
// var_dump($game->start());
