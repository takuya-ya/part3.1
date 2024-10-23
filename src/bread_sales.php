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
const TAX = 10;


/**
 * @return int[]
 */
function getInputs(): array
{
    /** @phpstan-ignore variable.undefined */
    $inputs = $argv;
    // [0]=>array([0]>1 [1]>10)
    $inputs = array_chunk(array_slice($inputs, 1), SPLIT_LENGTH);
    $bledSalesNums = [];
    // 商品番号=>販売個数の配列データ構造に変換
    foreach ($inputs as $input) {
            $bledSalesNums[$input[0]] = $input[1];
    }

    return $bledSalesNums;
}


/**
 * @param int[] $bledSalesNums 売上数値の配列
 * @return int
*/
function calTotalSales(array $bledSalesNums): int
{
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
    // 修正；そもそも小数点を使わない、定数TAXを整数で行う事でroundが不要になる
    // return round(($bledSales * (TAX*100))/100);
    return $bledSales * (TAX + 100) / 100;
}

/**
 * @param int[] $bledSalesNums 売上数値の配列
 * @return int[]
*/
function maxSales(array $bledSalesNums): array
{
    // 最大販売数量を求めて、その商品番号を抽出
    return array_keys($bledSalesNums, max($bledSalesNums));
}

/**
 * @param int[] $bledSalesNums 売上数値の配列
 * @return int[]
*/
function minSales(array $bledSalesNums): array
{
    // 最大販売数量を求めて、その商品番号を抽出
    return array_keys($bledSalesNums, min($bledSalesNums));
}

// 修正：関数の引き値がな長い(...可変長引数を使用する)
// function display(int $totalSales, array $maxSalesNum, array $minSalesNum):void {

/**
 * @param int[] $results 売上数値の配列
 */
function display(array ...$results): void
{

    // 削減：それぞれを個別で呼び出さない。引き値を全て配列に入れて、ループで出力する。自分の回答では、出力の途中でechoしていて不細工と思っていたのでその手があったかと思った。

        // // 合計売上を出力
        // echo "$totalSales" . PHP_EOL;

        // // 最多販売の商品番号を出力
        // // 修正：配列の要素をまとめて文字列として出力するならimplodeがある
        // foreach ($maxSalesNum as $maxNum) {
        //     echo "$maxNum" . " ";
        // }
        // echo PHP_EOL;

        // // 最少販売の商品番号を出力
        // // 修正：配列の要素をまとめて文字列として出力するならimplodeがある
        // foreach ($minSalesNum as $minNum) {
        //     echo "$minNum" . " ";
        // }
        // echo PHP_EOL;

    foreach ($results as $result) {
        // 配列の値でintがあるが、型は[0] => int　の配列なので、implodeでも処理できる
        // ↑嘘。
        echo implode(' ', $result) . PHP_EOL;
    }
}

$bledSalesNums = getInputs();
// 合計売上を計算
$totalSales = calTotalSales($bledSalesNums);
// 最も販売した商品番号
$maxSalesNum = maxSales($bledSalesNums);
// 最も販売しなかった商品番号
$minSalesNum = minSales($bledSalesNums);
// アウトプット
// エラー：[0]の型がint、配列に変更する必要があった。imploadで処理出来る形にする必要がある。引数に[]する事で即座にarrayになるとのこと
// display($totalSales, $maxSalesNum, $minSalesNum);
display([$totalSales], $maxSalesNum, $minSalesNum);
