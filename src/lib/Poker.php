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
    $handRoles = getRole($handRanks);
    // 役をランクに変換
    $roleRanks = getRoleRank($handRoles);

    /**
     * プレイやー情報[カードランク、カードランク、役ランク]
     * 勝敗を判定
     *      役の強さを判定
     *          役をランク化
     *          比較
     *      引き分けの場合、数字の強さを判定
     *          数字を引数から受ける
     *          max関数で呼ぶ
     *
     * 出力
     *   [役A、役B、勝者番号]
     */
return ['', '', 2];
}


function getRank(array $hands): array
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

function getRole(array $handRanks): array
{
    foreach($handRanks as $ranks)
    {
        if ($ranks[0] === $ranks[1])
        {
            $handRoles[] = 'pair';
        } elseif (($ranks[0] - $ranks[1]) === 1)
        {
            $handRoles[] = 'straight';
        } else
        {
            $handRoles[] = 'highCard';
        }
    }
    return $handRoles;
}

function getRoleRank(array $handRoles)
{
    foreach($handRoles as $handRole) {
        switch($handRole) {
            case 'highCard':
                $roleRanks[] = HIGH_CARD;
                break;
            case 'pair':
                $roleRanks[] = PAIR;
                break;
            case 'straight':
                $roleRanks[] = STRAIGHT;
                break;
        }
    }
    return $roleRanks;
}

showDown('CK', 'DJ', 'C10', 'H10');
