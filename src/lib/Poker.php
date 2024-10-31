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
    $hands = [$card1A, $card1B, $card2A, $card2B];

    // カードをランクに変換
    $handRanks = getRank($hands);
    // カードの役を判定
    judgeRole($handRanks);
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

function getRank(array $hands)
{
    // 各カードをマークと数字に分割して配列化
    $handNums = array_map(function($card) {
        return substr($card, 1);
    }, $hands);

    //数字をループでランクに変換
    foreach($handNums as $handNum) {
        $handRanks[] = CARD_RANK[$handNum];
    }
    // ランクをプレイヤー毎に分割して手札とする
    return array_chunk($handRanks, 2);
}

// function judgeRole(array $hands)
// {
//     if ($cards[0] === $cards[1])
//     {
//         $role = PAIR;
//     } elseif ($cards[0] === $cards[1])


// }

showDown('CK', 'DJ', 'C10', 'H10');
