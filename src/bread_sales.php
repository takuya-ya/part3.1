<?php

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
const TAX = 1.1;

function getInputs():array {
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
    $bledSales = 0;
    // 商品番号=>販売個数の連想配列に変換
    // 商品毎の売上
    foreach ($bledSalesNums as $productNum => $bledSalesNum) {
            // 削減：１行に出来る。個別商品の売上を残しておく必要はないので。
            // $sales = [$bledSalesNum * SALES_PRICE[$productNum]];
            // $bledSales = array_merge($bledSales, $sales);
            $bledSales += $bledSalesNum * SALES_PRICE[$productNum];
    }
    // 商品ごとの売上を合算して税込み金額に変換
    return round(($bledSales * (TAX*100))/100);
}

function maxSales(array $bledSalesNums):array {
    // 最大販売数量を求めて、その商品番号を抽出
    return array_keys($bledSalesNums, max($bledSalesNums));
}

function minSales(array $bledSalesNums):array {
    // 最大販売数量を求めて、その商品番号を抽出
    return array_keys($bledSalesNums, min($bledSalesNums));
}

function display(int $totalSales, array $maxSalesNum, array $minSalesNum):void {
        // 合計売上を出力
        echo "$totalSales" . PHP_EOL;

        // 最多販売の商品番号を出力
        foreach ($maxSalesNum as $maxNum) {
            echo "$maxNum" . " ";
        }
        echo PHP_EOL;

        // 最少販売の商品番号を出力
        foreach ($minSalesNum as $minNum) {
            echo "$minNum" . " ";
        }
        echo PHP_EOL;
}

$bledSalesNums = getInputs();
// 合計売上を計算
$totalSales = calTotalSales($bledSalesNums);
// 最も販売した商品番号
$maxSalesNum = maxSales($bledSalesNums);
// 最も販売しなかった商品番号
$minSalesNum = minSales($bledSalesNums);
// アウトプット
display($totalSales, $maxSalesNum, $minSalesNum);
