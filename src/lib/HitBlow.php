<?php

function hitCondition(array $arrayAnswer, int $place, int $num)
{
    return (int)$arrayAnswer[$place] === $num;
}

function blowCondition(array $arrayAnswer, int $num)
{
    return in_array($num, $arrayAnswer);
}

function judge(int $question, int $answer): array
{
    $hit = 0;
    $blow = 0;
    // 修正：重複していたので、前処理として統合
    $arrayAnswer = str_split($answer);
    //questionを配列にして、桁番号と数字を順次出力
    foreach (str_split($question) as $place => $num) {
        // HitかBlowの条件と合致した場合、インクリメント
        if (hitCondition($arrayAnswer, $place, $num)) {
            $hit++;
        } elseif (blowCondition($arrayAnswer, $num)) {
            $blow++;
        }
    }
    return [$hit, $blow];
}

judge(5684, 5684);
// リファクタ：foreachと条件式の変数を修正、複雑値を下げる
        // foreach(str_split(($answer)) as $answerPlace => $answerNum) {
            // Hitの条件を変数化
            // $hitCondition = ($place === $answerPlace && $num === $answerNum);
            // Blowの条件を変数化
            // $blowCondition = ($num === $answerNum);
