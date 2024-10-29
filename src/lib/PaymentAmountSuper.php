<?php

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

// 購入金額の合計を算出
function calcTotalPrice (array $nums): int
{
  $prices = [];
  foreach ($nums as $num)
  {
    $prices[] = PRODUCT_INFO[$num]['price'];
  }
  return array_sum($prices);
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


// 購入時間がタイムセール帯の場合、弁当半額
function timeSaleDiscount(string $time): int
{
    $timeDiscount = 0;
    // 商品情報を商品毎に出力
    foreach (PRODUCT_INFO as $key => $info)
    {
        // 商品が弁当か確認
        if ($info['type'] === 'bento')
        {
            // タイムセール時間帯であれば、商品価格の半額を割引に追加
            if ( ('23:00' >= "$time" ) && ( "$time" >= '20:00' ))
            {
                $timeDiscount += ($info['price'] / 2);
            }
        }
    }
    // 値引き合計額を返す
    return $timeDiscount;
}

function calcDiscount (string $time, array $nums): int
{
    $discountPrice = 0;
    // 購入した商品数を番号毎にカウント
    $countProductNums = array_count_values($nums);
    // 玉ねぎ複数購入の割引 + 弁当とドリンクのセット割引 + タイムセールによる割引

    return onion($countProductNums) + lunchDiscount($countProductNums) + timeSaleDiscount($time);
}

function calc (string $time, array $nums): int
{
    // 引数の商品番号を金額の配列に変換
    $totalPrice = calcTotalPrice ($nums);
    // 値引き額の合計
    $totalDiscount = calcDiscount ($time, $nums);
    return ((int)(($totalPrice - $totalDiscount) * (100 + TAX)) / 100);
}

calc ('21:00', [1, 1, 1, 3, 5, 7, 8, 9, 10]);
