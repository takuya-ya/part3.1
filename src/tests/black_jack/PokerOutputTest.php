<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\PokerOutput;

class PokerOutputTest extends TestCase
{
    private $pokerOutput;
    public function setUp(): void
    {
        // TestCaseのメソッド呼出し
        parent::setUp();
        // デフォルトモック値を設定
        $this->pokerOutput = new PokerOutput();
    }
    public function testDisplayPlayerCard()
    {
        $this->expectOutputString(
            "あなたの引いたカードは0です。" . PHP_EOL .
            "あなたの引いたカードは1です。" . PHP_EOL
        );
        $pokerOutput = new PokerOutput();
        $pokerOutput->displayPlayerCard(['takuya' => [0, 1]], ['takuya']);
    }

    public function testDisplayDealerCard()
    {
        $this->expectOutputString(
            "ディーラーの引いたカードは0です。" . PHP_EOL .
            "ディーラーの引いた2枚目のカードはわかりません。" . PHP_EOL . PHP_EOL
        );
        $pokerOutput = new PokerOutput();
        $pokerOutput->displayDealerCard([0, 1]);
    }

    public function testDisplayDealerTurn()
    {
        $this->expectOutputString(
            "ディーラーの引いたカードはH3です。" . PHP_EOL
        );
        $this->pokerOutput->displayDealerTurn('H3');
    }

    public function testDisplayAddDealerCard()
    {
        $this->expectOutputString(
            "ディーラーの引いた2枚目のカードはH2でした。" . PHP_EOL
            // "ディーラーの現在の得点は10です。" . PHP_EOL .
            // PHP_EOL
        );
        $this->pokerOutput->displayAddDealerCard(['dealerHand' => ['H1', 'H2']]);
    }

    public function testDisplayDealerScore()
    {
        $this->expectOutputString(
            "ディーラーの現在の得点は10です。" . PHP_EOL .
            PHP_EOL
        );
        $this->pokerOutput->displayDealerScore(10);
    }



}
