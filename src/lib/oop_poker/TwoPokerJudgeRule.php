<?php

namespace OopPoker;

class TwoPokerJudgeRule implements PokerJudgeRule
{
    public function getWinner(array $hands): int
    {
        $winner = 0;
        // プレイヤーの配列で勝負
        foreach (['hand rank', 'primary', 'secondly'] as $k) {
            if ($hands[0][$k] < $hands[1][$k]) {
                $winner = 2;
                break;
            } elseif ($hands[0][$k] > $hands[1][$k]) {
                $winner = 1;
                break;
            }
        }
        // 結果をリターン
        return $winner;
    }
}
