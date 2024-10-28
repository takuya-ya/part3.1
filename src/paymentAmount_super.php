<?php

// 1. 玉ねぎ 100円
// 2. 人参 150円
// 3. りんご 200円
// 4. ぶどう 350円
// 5. 牛乳 180円
// 6. 卵 220円
// 7. 唐揚げ弁当 440円
// 8. のり弁 380円
// 9. お茶 80円
// 10. コーヒー 100円


// a. 玉ねぎは3つ買うと50円引き

// b. 玉ねぎは5つ買うと100円引き

// c. 弁当と飲み物を一緒に買うと20円引き（ただし適用は一組ずつ）

// d. お弁当は20〜23時はタイムセールで半額

// 金額を計算するcalc関数を定義してください。
// calcメソッドは「購入時刻 商品番号 商品番号 商品番号 ...」を引数に取り、合計金額（税込み）を返します。
// 購入時刻はHH:MM形式（例. 20:00）とし、商品番号は1〜10の整数とします。
// 同時に買える商品は20個までです。また、購入時刻は9〜23時です。
// ◯実行例
// calc('21:00', [1, 1, 1, 3, 5, 7, 8, 9, 10])  //=> 1298

/**
 * データを受け取る
 *  データを整形
 * 計算する
 *  合計金額を計算
 *  割引を計算
 *      玉ねぎの個数をカウント　caseで分岐
 *      飲み物と弁当の個数をそれぞれカウント,minの数値×20円
 *      タイムセール if分で分岐
 *  合計金額-割引金額=値引き後合計金額
 * 税混合系金額出力する
 *  税率をかけて税込み金額を計算
 */

//  セット割を計算する為、typeキーを追加
const PRODUCT_INFO =  [
  1 => ['price' => 100, 'type' => 'material'],
  2 => ['price' => 150, 'type' => 'material'],
  3 => ['price' => 200, 'type' => 'material'],
  4 => ['price' => 350, 'type' => 'material'],
  5 => ['price' => 180, 'type' => 'drink'],
  6 => ['price' => 220, 'type' => 'material'],
  7 => ['price' => 440, 'type' => 'bento'],
  8 => ['price' => 380, 'type' => 'bento'],
  9 => ['price' => 80, 'type' => 'drink'],
  10 => ['price' => 100, 'type' => 'drink'],
];
const ONION_NUM_THREE = 3;
const ONION_NUM_FIVE = 5;
const ONION_DISCOUNT_THREE = 50;
const ONION_DISCOUNT_FIVE = 100;
const LUNCH_DISCOUNT = 20;

function calcTotalPrice (array $nums): int
{
    $prices = [];
    foreach ($nums as $num)
    {
        $prices[] = PRODUCT_INFO[$num]['price'];
    }
    var_dump(array_sum($prices));
    return 1;
}

function onion (array $countProductNums): int
{
  //玉ねぎの個数に応じて、値引き額を算出
    $TotalOnionDiscount = 0;
    if ($countProductNums[1] >= ONION_NUM_FIVE) {
        $TotalOnionDiscount = ONION_DISCOUNT_FIVE;
    } elseif ($countProductNums[1] >= ONION_NUM_THREE) {
        $TotalOnionDiscount = ONION_DISCOUNT_THREE;
    }
    var_dump($TotalOnionDiscount);
    return $TotalOnionDiscount;
}

// セットの割引額を算出
function lunchDiscount(array $countProductNums): int
{
    $bento = 0;
    $drink = 0;
    // 弁当とドリンクカテゴリに該当する商品をカウント
    foreach (PRODUCT_INFO as $productInfo) {
        if ($productInfo['type'] === 'bento') {
            $bento++;
        } elseif ($productInfo['type'] === 'drink') {
            $drink++;
        }
    }
    // セット数をカウントして割引単価と乗算
    return (LUNCH_DISCOUNT * min($bento, $drink));
}

function calcDiscount (array $nums): int
{
    $discountPrice = 0;
    // 購入した商品数を番号毎にカウント
    $countProductNums = array_count_values($nums);
    // 玉ねぎ複数購入の割引 + 弁当とドリンクのセット割引 + タイムセールによる割引
    lunchDiscount($countProductNums);

    // return $discountPrice= onion() + lunchDrinkSet() + timeSale();
    return 1;
}

function calc ($time, array $nums): int
{
    // 引数の商品番号を金額の配列に変換
    calcTotalPrice ($nums);
    // 値引き額の合計
    calcDiscount ($nums);
    return 1;
}

calc ('21:00', [1, 1, 1, 3, 5, 7, 8, 9, 10]);
