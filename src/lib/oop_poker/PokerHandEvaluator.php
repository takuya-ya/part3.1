<?php

require_once('PokerPlayer.php');
require_once('PokerCard.php');

class PokerHandEvaluator
{
    public function __construct()
    {
    }

    public function getHand(array $cardRanks): string
    {
        // インスタンスでget$ranku
        // 比較するランクを取得
        // インスタンスでgetHandメソッド実行
        // インスタンスの配列から値をとる
        // 配列を配列にするのでarraymapする
        $rank = array_map(fn($cardRank) => $cardRank->getRank(), $cardRanks);

        $hand = 'high card';
        if ($rank[0] === $rank[1])
        {
            $hand = 'pair';
        } elseif (abs(($rank[0] - $rank[1])) === 1)
        {
            $hand = 'straight';
        }
        return $hand;
    }
}
