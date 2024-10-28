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

const PRICE =  [
  1 => 100,
  2 => 150,
  3 => 200,
  4 => 350,
  5 => 180,
  6 => 220,
  7 => 440,
  8 => 380,
  9 => 80,
  10 => 100
];
const ONION_NUM_THREE = 3;
const ONION_NUM_FIVE = 5;
const ONION_DISCOUNT_THREE = 50;
const ONION_DISCOUNT_FIVE = 100;

function calcTotalPrice (array $nums): int
{
    $prices = [];
    foreach ($nums as $num)
    {
        $prices[] = PRICE[$num];
    }
    var_dump(array_sum($prices));
    return 1;
}

function onion (array $nums): int
{
    // 購入した商品数を番号ごとにカウント
    $countProductNums = array_count_values($nums);

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

function calcDiscount (array $nums): int
{
    $discountPrice = 0;
    // 玉ねぎ複数購入の割引
    // 弁当とドリンクのセット割引
    // タイムセールによる割引
    onion($nums);
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
