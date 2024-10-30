<?php

const CARD_RANK = [
    2 => 1,
    3 => 2,
    4 => 3,
    5 => 4,
    6 => 5,
    7 => 6,
    8 => 7,
    9 => 8,
    10 => 9,
    'J' => 10,
    'Q' => 11,
    'K' => 12,
    'A' => 13
];

const HIGH_CARD = 1;
const PAIR = 2;
const STRAIGHT = 3;

function showDown (string $card1A, string $card1B, string $card2A, string $card2B): array
{
    /**
     * 役を判定
     * プレイやー情報[カードランク、カードランク、役ランク]
     * 勝敗を判定
     *      役の強さを判定
     *      引き分けの場合、数字の強さを判定
     * 出力
     *   [役A、役B、勝者番号]
     */


    return ['', '', 2];
}
