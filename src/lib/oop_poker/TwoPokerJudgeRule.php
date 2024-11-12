<?php

namespace OopPoker;

require_once 'PokerJudgeRule.php';

class TwoPokerJudgeRule implements PokerJudgeRule
{
    public function getWinner(array $hands): int
    {
        $winner = 0;
        // プレイヤーの配列で勝負
        foreach(['hand rank', 'primary', 'secondly'] as $k) {
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
// $rule = new TwoPokerJudgeRule;
// $rule->getWinner([['name' => 'pair', 'hand rank' => 1, 'primary' => 9, 'secondly' => 9],['name' => 'pair', 'hand rank' => 2, 'primary' => 8, 'secondly' => 7]]);
