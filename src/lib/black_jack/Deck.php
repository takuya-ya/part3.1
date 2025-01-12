<?php

namespace BlackJack;

use BlackJack\Card;

require_once(__DIR__.'/Card.php');

class Deck
{
    public array $cardDeck = [];
    public function __construct(public Card $card)
    {
    }

    public function makeDeck()
    //  : void
    {
        // 52枚のカードを持つ配列のプロパティを初期設定
        // カードをシャッフル処理
        shuffle($this->card->cards);
        $this->cardDeck = $this->card->cards;
        return $this->cardDeck;
    }

    public function drawCard(int $drawCardNum) : array
    {
        $drawnCard = array_splice($this->cardDeck, 0, $drawCardNum);
        return $drawnCard;
    }
}
