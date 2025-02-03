<?php

namespace BlackJack;

class PointCalculator
{
    public function calculatePoint(array $hand): int
    {
        // 手札カードのrankを抽出するため、スートを除去。
        $ranks = [];
        $score = 0;
        foreach ($hand as $card) {
            $rank = substr($card, 1);

            // rankがJ,Q,Kの場合に'10'に変換
            $aceAndFaceCards = ['J', 'Q', 'K'];
            if (in_array($rank, $aceAndFaceCards)) {
                $rank = 10;
            }
            // rankがAの場合、スコアに応じてAを変換
            if (str_contains($rank, 'A')) {
                switch ($score) {
                    case $score <= 11; //11以下の場合、10を追加
                        $rank = 10;
                        break;
                    case $score >= 12; //12以上の場合、1を追加
                        $rank = 1;
                        break;
                }
            }
            $ranks[] = (int)$rank;
            // 手札スコアを計算するため、$ranksを合算。
            $score = array_sum($ranks);
        }
        // 出力
        return $score;
    }
}
