<?php

use function PHPUnit\Framework\equalTo;

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
const DRAW= 0;
const PLAYER1 = 1;
const PLAYER2 = 2;


function showDown (string $card1A, string $card1B, string $card2A, string $card2B): array
{
    // カードを配列として取得
    $hands = [$card1A, $card1B, $card2A, $card2B];

    // カードランクを取得
    $handRanks = getRank($hands);
    // カードの役を取得
    $handRoles = getRole($handRanks);
    // 役のランクを取得
    $roleRanks = getRoleRank($handRoles);
    // 勝者を判定
    $winner = judgeWinner($roleRanks, $handRanks, $handRoles);

    /**
     * プレイやー情報[カードランク、カードランク、役ランク]
     * 出力
     *   [役A、役B、勝者番号]
     */
return [$handRoles[0], $handRoles[1], $winner];
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
        } elseif (abs($ranks[0] - $ranks[1]) === 1 || abs($ranks[0] - $ranks[1]) === 12)
        {
            $handRoles[] = 'straight';
        } else
        {
            $handRoles[] = 'high card';
        }
    }
    return $handRoles;
}

function getRoleRank(array $handRoles)
{
    foreach($handRoles as $handRole) {
        switch($handRole) {
            case 'high card':
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

function judgeWinner(array $roleRanks, array $handRanks, array $handRoles) {
    if ($roleRanks[0] > $roleRanks[1]) {
        $winner = PLAYER1;
    } elseif ($roleRanks[0] < $roleRanks[1]) {
        $winner = PLAYER2;
    } else {
        // 役が同じ場合　カードのランクで比較
        $winner = compareCardNum($handRanks, $handRoles);
    }
    return $winner;
}

function compareCardNum(array $handRanks, array $handRoles) {

    $maxRank = MaxCardNum($handRanks);
    $minRank = MinCardNum($handRanks);
    // 手札で強いランク取得、弱いランク、
    // 引き分けた役毎に行う
    if($handRoles[0] === 'high card') {
        if($maxRank[0] > $maxRank[1]) {
            $winner = PLAYER1;
        } elseif ($minRank[0] < $minRank[1]) {
            $winner = PLAYER2;
        } else {
            $winner = compareCardMinNum($minRank);
        }
    // 強いランク同士を比較
    } elseif ($handRoles[0] === 'pair') {
        if($maxRank[0] > $maxRank[1]) {
            $winner = PLAYER1;
        } elseif ($maxRank[0] < $maxRank[1]) {
            $winner = PLAYER2;
        } else {
            $winner = DRAW;
        }
    } elseif ($handRoles[0] === 'straight') {
        // A-2の組み合わせの場合、2が最強
        $value = [CARD_RANK['A'], CARD_RANK[2]];
        $indent = 0;
        foreach($handRanks as $handRank) {
            if(empty(array_diff($value, $handRank))) {
                $maxRank[$indent] = CARD_RANK[2];
            }
            // if文の中に入れない事。中に入れると、プレイヤー2がA-2でも、その時点でindentは0だからプレイヤー1の手札が最弱になってしまう。
            $indent++;
        }

        if($maxRank[0] > $maxRank[1]) {
            $winner = PLAYER1;
        } elseif ($maxRank[0] < $maxRank[1]) {
            $winner = PLAYER2;
        } else {
            $winner = DRAW;
        }
    }
    return $winner;
}

function MaxCardNum($handRanks)
{
    foreach($handRanks as $handRank) {
        $maxRank[] = max($handRank);
    }
    return $maxRank;
}

function MinCardNum($handRanks)
{
    foreach($handRanks as $handRank) {
        $minRank[] = min($handRank);
    }
    return $minRank;
}

function compareCardMinNum($minRank) {
    if($minRank[0] > $minRank[1]) {
        $winner = PLAYER1;
    } elseif ($minRank[0] < $minRank[1]) {
        $winner = PLAYER2;
    } else {
        $winner = DRAW;
    }
    return $winner;
}
showDown('SA', 'DK', 'C2', 'CA');
