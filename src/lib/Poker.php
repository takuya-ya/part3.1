<?php

use function PHPUnit\Framework\equalTo;

// ：解答：defineでまとめて定数化
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

// 解　名前とランクの2つの情報が一つの箱にあると便利。だから　定数＝[name => 役名、　rank=>ランク]が良いかも
const HIGH_CARD = 1;
const PAIR = 2;
const STRAIGHT = 3;
const DRAW = 0;
const PLAYER1 = 1;
const PLAYER2 = 2;


function showDown(string $card1A, string $card1B, string $card2A, string $card2B): array
{
    // カードを配列として取得
    $hands = [$card1A, $card1B, $card2A, $card2B];

    // カードランクを取得
    $handRanks = getRank($hands);

    // 解答：getRole,getRoleRankを一つのcheckHand関数で実施
    // その際、judgeWinnerでのcompareCardNumによる役が同じで手札のランクで勝負,A-2のパターン処理もここで行い、勝負に必要な要素をプレイヤー毎に配列化してreturn。
    // 私は、役名、役のランク、カードの強弱をそれぞれ配列を作成している状態。$handRanks[1, 0]のように。プレイヤー毎に情報をまとめればいい。
    // カードの役を取得
    $handRoles = getRole($handRanks);
    // 役のランクを取得
    $roleRanks = getRoleRank($handRoles);

    // 勝者を判定
    // 解答：返ってきた配列の要素をループで回して勝負
    // それで勝負つかなければ、自動でDRAWの0がreturnされる
    // 必要な情報が配列に入っていることが重要。配列だからforeachで項目毎に勝負できる。更に連想配列にしていうので、呼び出しの項目も明確でわかりやすい。
    $winner = judgeWinner($roleRanks, $handRanks);
    return [$handRoles[0], $handRoles[1], $winner];
}

function getRank(array $hands): array
{
    $handRanks = [];
    // 各カードをマークと数字に分割して配列化
    $handNums = array_map(function ($card) {
        return substr($card, 1);
    }, $hands);

    //数字をループでランクに変換
    foreach ($handNums as $handNum) {
        $handRanks[] = CARD_RANK[$handNum];
    }
    // ランクをプレイヤー毎に分割して手札とする
    return array_chunk($handRanks, 2);
}

// 解　ここで、役名、手札で強いカード、弱いカードのランク、役のランクをセットにした配列を作成。重要なのはこの関数の呼び出し元で、プレイヤー毎に引数に入れたら楽。array_mapなら、配列から値を全て取得して、returnも配列化出来る。関数内でforeachとリターンの配列化をしてもいいけど。
function getRole(array $handRanks): array
{
    //解 ここで困ったのが、役名を引き出すのが難しいということ。定数名で$handRolesに入れればよかったのかも。解答のように、定数で小文字役名設定して、HAND_RANK定数を配列にして、役とランクを連想配列にすればよかった。役名の大文字で役名が、HAND_RANK[役名]でランクが取得できるようになる。
    $handRoles = [];
    foreach ($handRanks as $ranks) {
        // 解　ここでmaxとminも求める

        $handRole = 'high card';
        if ($ranks[0] === $ranks[1]) {
            $handRole = 'pair';
            // 12がマジック定数になっている
        } elseif (abs($ranks[0] - $ranks[1]) === 1 || abs($ranks[0] - $ranks[1]) === 12) {
            $handRole = 'straight';
            // ここでstraightのA-2のmax minも設定すればいい
        }
        $handRoles[] = $handRole;
    //解 役名、役ランク、強いカード、弱いカード、の配列を返す
    }
    return $handRoles;
}
// 解　ここが不要になる
function getRoleRank(array $handRoles): array
{
    $roleRanks = [];
    foreach ($handRoles as $handRole) {
        switch ($handRole) {
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

function judgeWinner(array $roleRanks, array $handRanks): int
{
    // 解　これも不要になる。上記のifとelseifの段階で該当すればreturn.returnかからず最後まで来たら次の要素のループ（つまり、役の強さがequalだということ。1つのループでcompareCardNumの機能も行える）
    // 役が同じ場合　カードのランクで比較
    $winner = compareCardNum($handRanks);

    if ($roleRanks[0] > $roleRanks[1]) {
        $winner = PLAYER1;
    } elseif ($roleRanks[0] < $roleRanks[1]) {
        $winner = PLAYER2;
    }
    return $winner;
}

// $handRank[0],$handRank[1]と渡せば、関数内での処理でforeach不要。
function compareCardNum(array $handRanks): int
{
    // 中でforeachを両方の関数でする必要が出るので、引数に両プレイヤーのランクを渡す
    $maxRank = MaxCardNum($handRanks);
    $minRank = MinCardNum($handRanks);

    // $value = [CARD_RANK['A'], CARD_RANK[2]];
    $indent = 0;
    foreach ($handRanks as $handRank) {
        // ここも差分が絶対値12ならA-2に該当するのでempty関数じゃなくて1文で導出可能
        // if (empty(array_diff($value, $handRank))) {
        if (abs($handRank[0] - $handRank[1]) === 12) {
            $maxRank[$indent] = CARD_RANK[2];
        }
        // エラー：if文の中$indentを入れない事。中に入れると、プレイヤー2がA-2でも、Player1が条件に合致しない,if文処理スキップ,$indent増加しない、P2が条件合致してP1の手札に最弱を代入。という形になってしまう。
        $indent++;
    }

    // 解　役毎に条件分岐しなくていい。同点の場合の比較は役関係なく同じなので、この関数自体がそもそも不要。judge関数でforeachすればいいだけ。
    // 手札で強いランク取得、弱いランク、
    // 引き分けた役毎に行う
    $maxMinRank = [$maxRank, $minRank];
    $winner = DRAW;
    foreach ($maxMinRank as $rank) {
        if ($rank[0] > $rank[1]) {
            $winner = PLAYER1;
        } elseif ($rank[0] < $rank[1]) {
            $winner = PLAYER2;
        }
    }
    return $winner;
}
    // if ($handRoles[0] === 'high card') {
    //     if ($maxRank[0] > $maxRank[1]) {
    //         $winner = PLAYER1;
    //     } elseif ($minRank[0] < $minRank[1]) {
    //         $winner = PLAYER2;
    //     } else {
    //         $winner = compareCardMinNum($minRank);
    //     }
    // // 強いランク同士を比較
    // } elseif ($handRoles[0] === 'pair') {
    //     if ($maxRank[0] > $maxRank[1]) {
    //         $winner = PLAYER1;
    //     } elseif ($maxRank[0] < $maxRank[1]) {
    //         $winner = PLAYER2;
    //     } else {
    //         $winner = DRAW;
    //     }
    // } elseif ($handRoles[0] === 'straight') {
    //     // A-2の組み合わせの場合、2が最強
    //     $value = [CARD_RANK['A'], CARD_RANK[2]];
    //     $indent = 0;
    //     foreach ($handRanks as $handRank) {
    //         // ここも差分が絶対値12ならA-2に該当するのでempty関数じゃなくて1文で導出可能
    //         if (empty(array_diff($value, $handRank))) {
    //             $maxRank[$indent] = CARD_RANK[2];
    //         }
    //         // エラー：if文の中$indentを入れない事。中に入れると、プレイヤー2がA-2でも、Player1が条件に合致しない,if文処理スキップ,$indent増加しない、P2が条件合致してP1の手札に最弱を代入。という形になってしまう。
    //         $indent++;
    //     }

    //     if ($maxRank[0] > $maxRank[1]) {
    //         $winner = PLAYER1;
    //     } elseif ($maxRank[0] < $maxRank[1]) {
    //         $winner = PLAYER2;
    //     } else {
    //         $winner = DRAW;
    //     }
    // }
    // return $winner;


// 解 foreachが重複、関数に$handRankを渡しせば削除可能。そもそも、手札の情報を作る関数(checkHand)でmax関数結果を変数名に入れればいいだけ。関数化する必要なし,MinCardNumも含めて。
function MaxCardNum($handRanks): array
{
    $maxRank = [];
    foreach ($handRanks as $handRank) {
        $maxRank[] = max($handRank);
    }
    return $maxRank;
}

function MinCardNum($handRanks): array
{
    $minRank = [];
    foreach ($handRanks as $handRank) {
        $minRank[] = min($handRank);
    }
    return $minRank;
}
//解 judge内のforeachで処理可能
function compareCardMinNum($minRank): int
{
    $winner = DRAW;
    if ($minRank[0] > $minRank[1]) {
        $winner = PLAYER1;
    } elseif ($minRank[0] < $minRank[1]) {
        $winner = PLAYER2;
    }
    return $winner;
}
showDown('SA', 'DK', 'C2', 'CA');
