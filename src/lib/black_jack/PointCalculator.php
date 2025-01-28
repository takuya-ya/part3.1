<?php

namespace BlackJack;

class PointCalculator
{
    public function calculatePoint(array $hand): int
    {
        // 手札カードをrank化。スートを除去により。
        $ranks = [];
        foreach ($hand as $card) {
            $rank = substr($card, 1);

            // rankがJ,Q,K,Aの場合に'10'に変換
            $aceAndFaceCards = ['J', 'Q', 'K', 'A'];
            if (in_array($rank, $aceAndFaceCards)) {
                $rank = 10;
            }
            $ranks[] = (int)$rank;
        }
        // 手札スコアを計算。rankを合算して。
        $score = array_sum($ranks);
        // 出力
        return $score;
    }
}
