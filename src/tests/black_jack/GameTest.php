<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\Card;
use BlackJack\Deck;
use BlackJack\Game;
use BlackJack\Dealer;
use BlackJack\GameProcess;
use BlackJack\PointCalculator;

require_once(__DIR__ . '/../../lib/black_jack/Card.php');
require_once(__DIR__ . '/../../lib/black_jack/Deck.php');
require_once(__DIR__ . '/../../lib/black_jack/Game.php');
require_once(__DIR__ . '/../../lib/black_jack/Dealer.php');
require_once(__DIR__ . '/../../lib/black_jack/GameProcess.php');
require_once(__DIR__ . '/../../lib/black_jack/PointCalculator.php');

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
        $deck = new Deck($card);
        $dealer = new Dealer();
        $pointCalculator = new PointCalculator();
        $gameProcess = new GameProcess($dealer, $deck, $pointCalculator, $this->inputHandle);
        $game = new Game($deck, $gameProcess, $dealer, $pointCalculator, ['takuya']);
        $this->assertSame('ブラックジャックを終了します。' .PHP_EOL, $game->start());
    }
}
