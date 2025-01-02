<?php

namespace BlackJack;

use BlackJack\Card;

require_once(__DIR__.'/Card.php');

class Deck
{
    public function __construct(public Card $card)
    {
    }

    // TODO 山札作成（シャフルまで）
    public function makeDeck()
    {
        // 52枚のカードを持つ配列のプロパティを初期設定
        // カードをシャッフル処理
        shuffle($this->card->cards);
        return $this->card->cards;
    }

    // 人数分のデッキを作成
    // TODO:人数増加に対応させる
    public function drawCard()
    {
        $playerCards = [];
        // ディーラー含む２名分のカード４枚をスライス
        // カードを手札用に2枚単位で分割してプレイヤー２名分のカードを準備

        $playerCards = array_chunk(array_slice($this->makeDeck(), 0, 4), 2);
        return $playerCards;
    }
}
