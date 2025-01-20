<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\GameProcess;
use BlackJack\Card;
use BlackJack\Deck;
use BlackJack\Dealer;
use BlackJack\PointCalculator;

require_once(__DIR__ . '/../../lib/black_jack/GameProcess.php');
require_once(__DIR__ . '/../../lib/black_jack/Card.php');
require_once(__DIR__ . '/../../lib/black_jack/Deck.php');
require_once(__DIR__ . '/../../lib/black_jack/Dealer.php');
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

}
