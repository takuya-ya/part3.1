<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\GameProcess;
use BlackJack\Card;
use BlackJack\Deck;
use BlackJack\Dealer;
use BlackJack\Player;
use BlackJack\PointCalculator;

require_once(__DIR__ . '/../../lib/black_jack/GameProcess.php');
require_once(__DIR__ . '/../../lib/black_jack/Card.php');
require_once(__DIR__ . '/../../lib/black_jack/Deck.php');
require_once(__DIR__ . '/../../lib/black_jack/Dealer.php');
require_once(__DIR__ . '/../../lib/black_jack/Player.php');
require_once(__DIR__ . '/../../lib/black_jack/PointCalculator.php');

class GameProcessTest extends TestCase
{
    public function testDrawStartHands() {
        $deck = new Deck(new Card);
        $pointCalculator = new PointCalculator;
        $mock = $this->createMock(Dealer::class);
        $mock->method('dealStartHands')->willReturn(['takuya' => ['K1', 'K2']]);
        $mock->method('makeDealerHand')->willReturn(['D1', 'D2']);
        $gameProcess = new GameProcess($mock, $deck, $pointCalculator);
        $hands = $gameProcess->drawStartHands(['takuya']);
        $this->assertSame(['takuya' => ['K1', 'K2']], $hands['playerHands']);
    }

    public function testDealerTurn() {
        $deck = new Deck(new Card);
        $pointCalculator = new PointCalculator;

        $mock = $this->createMock(Dealer::class);
        $mock->method('dealAddCard')->willReturn(['H6']);

        $gameProcess = new GameProcess($mock, $deck, $pointCalculator);
        $dealerScore = $gameProcess->dealerTurn(['D1', 'DA'], 11);
        $this->assertSame(23, $dealerScore);
    }

    public function testAddDealerCard()
    {
        $deck = new Deck(new Card);
        $pointCalculator = new PointCalculator;

        $dealerMock = $this->getMockBuilder(Dealer::class)
        ->onlyMethods(['dealAddCard'])
        ->getMock();
        $dealerMock->method('dealAddCard')->willReturn(['H10']);

        $gameProcess = new GameProcess($dealerMock, $deck, $pointCalculator);
        $dealerScore = $gameProcess->addDealerCard(['dealerHand' => ['D6', 'D5']]);

        // 返り値を確認
        $this->assertSame(21, $dealerScore);
    }

    public function testAddPlayerCard()
    {
        $deck = new Deck(new Card);
        $player = new Player('takuya');
        $pointCalculator = new PointCalculator;

        $mock = $this->createMock(Dealer::class);
        $mock->method('dealAddCard')->willReturnOnConsecutiveCalls(['D3'], ['K10']);

        // 返り値の確認
        $gameProcess = new GameProcess($mock, $deck, $pointCalculator);
        $playerScore = $gameProcess->addPlayerCard(
            // ['Y', 'N'],
            ['playerHands' => ['takuya' => ['D6', 'D7']]],
            'takuya', $player);
        $this->assertSame(16, $playerScore);

        // スコアが21を超えた場合に、バースト判定の確認
        $message = $gameProcess->addPlayerCard(
            // ['Y'],
            ['playerHands' => ['takuya' => ['D6', 'D7']]],
            'takuya', $player);
        $this->assertSame('あなたの負けです。', $message);

        // // 追加のカードを引かない場合の仮実装
        // $deck->cardDeck =['P5', 'P5', 'D10', 'D10', 'P11'];
        // $playerHand = $game->start();
        // $this->assertSame('テスト用出力', $playerHand);
    }

    public function testJudgeWinner()
    {
        $deck = new Deck(new Card);
        $pointCalculator = new PointCalculator;

        $mock = $this->createMock(Dealer::class);

        // 返り値の確認
        $gameProcess = new GameProcess($mock, $deck, $pointCalculator);
        $winner = $gameProcess->judgeWinner(21, 20, 'takuya');
        $this->assertSame('takuya', $winner);

        $winner = $gameProcess->judgeWinner(20, 21, 'takuya');
        $this->assertSame('ディーラー', $winner);
    }

}
