<?php

// * データの取得

//  * データの加工
//  * データの比較
//  * 判定

function judge($question,$answerer)
{
    // データの加工　配列にして比較したい
$place = 0;
$num = 0;
$answerPlace = 0;
$answerNum = 0;
$hit = 0;
$blow = 0;
foreach(str_split($question) as $place => $num) {
    foreach(str_split(($answerer)) as $answerPlace => $answerNum) {
        $hitCondition = ($place === $answerPlace && $num === $answerNum);
        $blowCondition = ($num === $answerNum);
        if($hitCondition){
            $hit++;
        } elseif ($blowCondition) {
            $blow++;
        }
    }
}
}

judge(5678,5678);
