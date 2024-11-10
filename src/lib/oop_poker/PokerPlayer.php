<?php

namespace OopPoker;

require_once('PokerCard.php');

class PokerPlayer
{
    // 引数；各カードのインスタンス
    // /**
    //  *  @param PokerCard[] $pokerCards プレイヤーのカード配列
    //  */
    public function __construct(private array $pokerCards)
    {
    }

    // PokerCardのgetRank関数を使用、数字をランクに変換
    public function getCardRank(): array
    {
        // H10のインスタンス　＝＞　各カードのインスタンスがgetRank実行
        // 冒頭でコンストラクトに各カードをPokerCardクラスに渡している
        return array_map(fn($card) => $card->getRank(), $this->pokerCards);
        // 修正　下記はpokerCardクラスで行う
        // $card = new PokerCard($this->cards);
        // return $card->getRank();
        // return $cardRanks = [[10, 10], [1, 1]];
    }
}
