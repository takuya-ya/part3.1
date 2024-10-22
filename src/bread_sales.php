<?php

// ①100②120③150④250⑤80⑥120⑦100⑧180⑨50⑩300
// 一日の売上の合計（税込み）と、販売個数の最も多い商品番号と販売個数の最も少ない商品番号を求めてください。

//〇インプット：
//販売した商品番号 販売個数 販売した商品番号 販売個数 ...」
//※ただし、販売した商品番号は1〜10の整数とする
// 1 10 2 3 5 1 7 5 10 1

// ◯アウトプット例
// 2464
// 1
// 5 10
// 売上の合計税込み
  //個数＊金額＊税率
  //※ただし、税率は10%とする
// 販売個数の最も多い商品番号
// 販売個数の最も少ない商品番号
// ※また、販売個数の最も多い商品と販売個数の最も少ない商品について、販売個数が同数の商品が存在する場合、それら全ての商品番号を記載すること

// タスクばらし
    //データ取得
    //データ構造
        //商品番号の配列に商品金額と個数の多次元配列　[1] = array[商品金額、販売個数]　
        // ではなく、商品番号　＝＞　個数の連想配列
    // 税込み売り上げ
    // 販売個数の最も多い商品番号
    // 販売個数の最も少ない商品番号

const SALES_PRICE = [
    1 => 100,
    2 => 120,
    3 => 150,
    4 => 250,
    5 => 80,
    6 => 120,
    7 => 100,
    8 => 180,
    9 => 50,
    10 => 300
];
const SPLIT_LENGTH = 2;
const TAX = 1.08;

function getInputs() {
    $inputs = $_SERVER['argv'];
    // [0]=>array([0]>1 [1]>10)
    $inputs = array_chunk(array_slice($inputs, 1), SPLIT_LENGTH);
    $bledSalesNums = [];
    // 商品番号=>販売個数の配列データ構造に変換
    foreach ($inputs as $input) {
            $bledSalesNums[$input[0]] = $input[1];
    }
    return $bledSalesNums;
}

function calTotalSales(array $bledSalesNums):int {
    $bledSales = [];
    // 商品番号=>販売個数の連想配列に変換
    // 商品毎の売上
    foreach ($bledSalesNums as $productNum => $bledSalesNum) {
            $sales = [$bledSalesNum * SALES_PRICE[$productNum]];
            $bledSales = array_merge($bledSales, $sales);
    }
    // 商品ごとの売上を合算して税込み金額に変換
    return round((array_sum($bledSales) * (TAX*100))/100);
}

function maxSales(array $bledSalesNums):array {
    // 最大販売数量を求めて、その商品番号を抽出
    return array_keys($bledSalesNums, max($bledSalesNums));
}

function minSales(array $bledSalesNums):array {
    // 最大販売数量を求めて、その商品番号を抽出
    return array_keys($bledSalesNums, min($bledSalesNums));
}

$bledSalesNums = getInputs();
// 合計売上を計算
$totalSales = calTotalSales($bledSalesNums);
// 最も販売した商品番号
$maxSalesNum = maxSales($bledSalesNums);
$minSalesNum = minSales($bledSalesNums);
// display($bledSalesNums, $totalSales, $maxSalesNum, $minSalesNum);
