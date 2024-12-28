<?php

namespace BlackJack;

use BlackJack\Card;

require_once(__DIR__.'/Card.php');

class Deck
{
    // TODO:人数増加に対応させる
    public function drawCard()
    {
        $playerCards = [];

        // 52枚のカードを持つ配列のプロパティを初期設定
        $card = new Card;
        // カードをシャッフル処理
        shuffle($card->cards);
        // ディーラー含む２名分のカード４枚をスライス
        // カードを手札用に2枚単位で分割してプレイヤー２名分のカードを準備
        $playerCards = array_chunk(array_slice($card->cards, 0, 4), 2);
        return $playerCards;
    }
}
