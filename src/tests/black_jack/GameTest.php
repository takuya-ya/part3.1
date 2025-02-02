<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\Card;
use BlackJack\Dealer;
use BlackJack\Deck;
use BlackJack\Game;
use BlackJack\GameProcess;
use BlackJack\PointCalculator;
use BlackJack\PokerOutput;


class GameTest extends TestCase
{
    private $inputHandle = '';
    public function setUp(): void
    {
        // TestCaseのメソッド呼出し
        parent::setUp();
        // デフォルトモック値を設定
        $this->inputHandle = fopen('php://temp', 'r+');
    }

    public function tearDown(): void
    {
        // stream_wrapper_restore('php');
        fclose($this->inputHandle);
        // TestCaseのメソッド呼出して初期化
        parent::tearDown();
    }

    public function testStart()
    {
        // 返り値の確認
        fwrite($this->inputHandle, "Y"); // ユーザー入力の代替値を設定
        rewind($this->inputHandle); //ストリームポインタをリセット

        $card = new Card();
        $dealer = new Dealer();
        $deck = new Deck($card);
        $pointCalculator = new PointCalculator();
        $pokerOutput = new PokerOutput();
        $gameProcess = new GameProcess($dealer, $deck, $pointCalculator, $pokerOutput, $this->inputHandle);
        $game = new Game($deck, $gameProcess, $dealer, $pointCalculator, ['takuya']);
        $this->assertSame('ブラックジャックを終了します。' .PHP_EOL, $game->start());
    }
}
