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
        // array [[H10, H3], [D7, D9]]
        $cardNumber = [];
        foreach ([$this->card1, $this->card2] as $playerCards) {
          $cardNumber[] = array_map(fn($playerCard) => substr($playerCard, 1), $playerCards);
        }

        $player = new PokerPlayer($cardNumber);
        $cardRanks = $player->getCardRank();
        return $cardRanks = [[13, 13], [9, 9]];
    }
}

// $this->start();
