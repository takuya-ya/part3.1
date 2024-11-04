<?php

require_once('PokerPlayer.php');

class PokerGame
{
    public function __construct(private array $card1, private array $card2)
    {
    }

    public function start(): array
    {
        // カードの数字を抽出して、配列化
        // array [[10, 3], [7, 9]]
        $cardNumbers = [];
        foreach ([$this->card1, $this->card2] as $playerCards) {
          $cardNumbers[] = array_map(fn($playerCard) => substr($playerCard, 1), $playerCards);
        }

                // カードの数字をランクに変換
        $player = new PokerPlayer($cardNumbers);
        $cardRanks = $player->getCardRank();
        return $cardRanks = [[13, 13], [9, 9]];
    }
}

// $this->start();
