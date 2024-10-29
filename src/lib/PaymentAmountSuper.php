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

// 修正：変数名
const ONION_NUM_THREE = 3;
const ONION_NUM_FIVE = 5;
const ONION_DISCOUNT_THREE = 50;
const ONION_DISCOUNT_FIVE = 100;
const LUNCH_DISCOUNT = 20;

// 購入金額の合計を算出
function calcTotalPrice (array $items): int
{
    $totalAmount = 0;
    // 変数名変更　$items > $items, $num > item
    // 構造変更　変更前：配列にして合算、変更後:加算を繰り返す　別に行数削減ならず、どっちでもいいかも
    foreach ($items as $item)
    {
        $totalAmount += PRODUCT_INFO[$item]['price'];
    }
    return $totalAmount;
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
function lunchDiscount(): int
{
  $bento = 0;
  $drink = 0;
  // 弁当とドリンクカテゴリに該当する商品をカウント
    // 弁当のループが重複しているので、別の箇所で行い、変数を使いまわす方がよかった
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
              // 時間を定数にする、時間の比較はstrtotimeでタイムスタンプにして比較。23時までの条件は不要。
              // 20時前なら値引きは０、のif文でリターンすれば変数不要だった
              // if (strtotime(BENTO_DISCOUNT_START_TIME) > strtotime($time)) {
              //   return 0;
              //   }
            if ( ('23:00' >= "$time" ) && ( "$time" >= '20:00' ))
            {
                $timeDiscount += ($info['price'] / 2);
            }
        }
    }
    // 値引き合計額を返す
      // 割り算を使用しているので、念のため（int）で型キャストすべきところ
    return $timeDiscount;
}

function calcDiscount (string $time, array $items): int
{
    $discountPrice = 0;
    // 購入した商品数を番号毎にカウント
      // onion関数でしか使用しないので、変数代入せず、onion関数の引き数にする
    // $countProductNums = array_count_values($items);

    // 玉ねぎ複数購入の割引 + 弁当とドリンクのセット割引 + タイムセールによる割引
    return onion(array_count_values($items)) + lunchDiscount() + timeSaleDiscount($time);
}

function calc (string $time, array $items): int
{
    // 引数の商品番号を金額の配列に変換
    $totalPrice = calcTotalPrice ($items);
    // 値引き額の合計
    $totalDiscount = calcDiscount ($time, $items);
    return ((int)(($totalPrice - $totalDiscount) * (100 + TAX)) / 100);
}

calc ('21:00', [1, 1, 1, 3, 5, 7, 8, 9, 10]);
