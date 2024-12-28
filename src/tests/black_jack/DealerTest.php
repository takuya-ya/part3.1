<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\Dealer;

require_once(__DIR__ . '/../../lib/black_jack/Dealer.php');

class DealerTest extends TestCase
{
    public function testDealingCard()
    {
        $dealer = new Dealer;
        // プレイヤー達のカードの手札が格納された配列を返す
        // $playersCard[名前]=各プレイヤーのカード
        $playersCard = $dealer->dealingCard(['takuya']);
        // 型の確認
        $this->assertSame('array', gettype($playersCard));
        // 人数分の手札の確認
        $this->assertSame(2 , count($playersCard));
        // 各プレイヤーの手札枚数の確認
        $this->assertSame(1 , count($playersCard[0]));
        $this->assertSame(2 , count($playersCard[1]));
    }
}
