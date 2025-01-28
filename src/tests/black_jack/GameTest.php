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
  public function setUp(): void
  {
      // TestCaseのメソッド呼出し
      parent::setUp();
      // デフォルトモック値を設定
      $GLOBALS['STDIN'] = fopen('php://temp', 'r+');

      // デフォルトのストリームラッパーをモックに置き換える
      // stream_wrapper_unregister('php');
      // stream_wrapper_register('php', MockStreamWrapper::class);
  }

  public function tearDown(): void
  {
      // stream_wrapper_restore('php');
      fclose($GLOBALS['STDIN']);
      // TestCaseのメソッド呼出して初期化
      parent::tearDown();
  }

    public function testStart()
    {
        // 返り値の確認
        fwrite($GLOBALS['STDIN'],  "Y"); // ユーザー入力の代替値を設定
        rewind($GLOBALS['STDIN']); //ストリームポインタをリセット

        $card = new Card;
        $deck = new Deck($card);
        $dealer = new Dealer($deck);
        $pointCalculator = new PointCalculator;
        $gameProcess = new GameProcess($dealer, $deck, $pointCalculator, $GLOBALS['STDIN']);
        $game = new Game($deck, $gameProcess, $dealer, $pointCalculator, ['takuya']);
        $this->assertSame('ブラックジャックを終了します。', $game->start());
    }
}
