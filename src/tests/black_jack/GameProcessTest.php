<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\GameProcess;
use BlackJack\Card;
use BlackJack\Deck;
use BlackJack\Dealer;
use BlackJack\Player;
use BlackJack\PointCalculator;
use BlackJack\PokerOutput;

class GameProcessTest extends TestCase
{
    private $handle = '';
    private $deck;
    private $pointCalculator;
    private $pokerOutput;

    public function setUp(): void
    {
        // TestCaseのメソッド呼出し
        parent::setUp();
        // デフォルトモック値を設定
        $this->handle = fopen('php://temp', 'r+');
        $this->deck = new Deck(new Card());
        $this->pointCalculator = new PointCalculator();
        $this->pokerOutput = new PokerOutput();
    }

    public function tearDown(): void
    {
        fclose($this->handle);
        // TestCaseのメソッド呼出して初期化
        parent::tearDown();
    }

    public function testDrawStartHands()
    {
        $mock = $this->createMock(Dealer::class);
        $mock->method('dealStartHands')->willReturn(['takuya' => ['K1', 'K2']]);
        $mock->method('makeDealerHand')->willReturn(['D1', 'D2']);

        $gameProcess = new GameProcess($mock, $this->deck, $this->pointCalculator, $this->pokerOutput);
        $hands = $gameProcess->drawStartHands(['takuya']);
        $this->assertSame(['takuya' => ['K1', 'K2']], $hands['playerHands']);
    }

    public function testDealerTurn()
    {
        $mock = $this->createMock(Dealer::class);
        $mock->method('dealAddCard')->willReturn(['H6']);

        $gameProcess = new GameProcess($mock, $this->deck, $this->pointCalculator, $this->pokerOutput);
        $dealerScore = $gameProcess->dealerTurn(['D1', 'DA'], 11);
        $this->assertSame(23, $dealerScore);
    }

    public function testAddDealerCard()
    {
        $dealerMock = $this->getMockBuilder(Dealer::class)
            ->onlyMethods(['dealAddCard'])
            ->getMock();
        $dealerMock->method('dealAddCard')->willReturn(['H10']);

        $gameProcess = new GameProcess($dealerMock, $this->deck, $this->pointCalculator, $this->pokerOutput);
        // 返り値を確認
        $dealerScore = $gameProcess->addDealerCard(['dealerHand' => ['D6', 'D5']]);
        $this->assertSame(21, $dealerScore);
        // バーストした場合
        $dealerScore = $gameProcess->addDealerCard(['dealerHand' => ['D6', 'D7']]);
        $this->assertSame('あなたの勝ちです。', $dealerScore);

    }

    public function testAddPlayerCard()
    {
        // 初期設定
        $deck = new Deck(new Card());
        $player = new Player('takuya');
        $pointCalculator = new PointCalculator();

        $mock = $this->createMock(Dealer::class);
        $mock->method('dealAddCard')->willReturnOnConsecutiveCalls(['D3'], ['K10']);

        // 返り値の確認
        fwrite($this->handle, "Y\nN\n"); // ユーザー入力の代替値を設定
        rewind($this->handle); //ストリームポインタをリセット

        $gameProcess = new GameProcess($mock, $this->deck, $this->pointCalculator, $this->pokerOutput, $this->handle);
        $playerScore = $gameProcess->addPlayerCard(
            ['playerHands' => ['takuya' => ['D6', 'D7']]],
            'takuya',
            $player
        );
        $this->assertSame(16, $playerScore);

        // スコアが21を超えた場合に、バースト判定の確認
        fwrite($this->handle, "Y\nY\n");
        rewind($this->handle);

        $message = $gameProcess->addPlayerCard(
            ['playerHands' => ['takuya' => ['D6', 'D7']]],
            'takuya',
            $player
        );
        $this->assertSame('あなたの負けです。', $message);
    }

    public function testJudgeWinner()
    {
        $deck = new Deck(new Card());
        $pointCalculator = new PointCalculator();

        $mock = $this->createMock(Dealer::class);

        // 返り値の確認
        $gameProcess = new GameProcess($mock, $this->deck, $this->pointCalculator, $this->pokerOutput);
        $winner = $gameProcess->judgeWinner(21, 20, 'takuya');
        $this->assertSame('takuya', $winner);
        $winner = $gameProcess->judgeWinner(20, 21, 'takuya');
        $this->assertSame('ディーラー', $winner);
    }
}
