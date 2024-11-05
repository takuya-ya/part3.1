<?php

namespace BreadSales;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../lib/Before_Poker/BreadSales.php';

class BreadSalesTest extends TestCase
{
    public function test(): void
    {
        $output = <<<EOT
        2464
        1
        5 10

        EOT;

        // $this->assertSame(4, getInput(4));
        $this->expectOutputString($output);

        //数字の引数には'が無くても動作した
        $bledSalesNums = getInputs(['file','1', '10', '2', '3', '5', '1', '7', '5', '10', '1']);
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
    }
}
