<?php

function hitCondition($answer, int $place, int $num)
{
    return ((int)str_split($answer)[$place]) === $num;
}

function blowCondition($answer, int $place, int $num)
{
    return in_array($num, str_split($answer));
}

function judge(int $question, int $answer): array
{
    $place = 0;
    $num = 0;
    $hit = 0;
    $blow = 0;
    //questionを配列にして、桁番号と数字を順次出力
    foreach(str_split($question) as $place => $num) {
        // HitかBlowの条件と合致した場合、インクリメント
        if(hitCondition($answer, $place, $num)){
            $hit++;
        } elseif (blowCondition($answer, $place, $num)) {
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
