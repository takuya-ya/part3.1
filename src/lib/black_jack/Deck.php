<?php

namespace BlackJack;

use BlackJack\Card;

require_once(__DIR__.'/Card.php');

class Deck
{
    private array $cardDeck;
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

    // 人数分のデッキを作成
    // // TODO:人数増加に対応させる
    // public function drawCard(int $drawCardNum) : array
    // {
    //     $drawnCard = array_splice($this->cardDeck, $drawCardNum);
    //     return $drawnCard;
    //     // $playerCards = [];

    //     // // ディーラー含む２名分のカード４枚をスライス
    //     // // カードを手札用に2枚単位で分割してプレイヤー２名分のカードを準備
    //     // $playerCards = array_chunk(array_slice($this->makeDeck(), 0, 4), 2);
    //     // return $playerCards;
    // }
}
