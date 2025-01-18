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
    public function testDealerTurn() {
        $mock = $this->createMock(Dealer::class);
        $mock->method('dealAddCard')->willReturn(['H6']);

        $gameProcess = new GameProcess($mock, new Deck(new Card), new PointCalculator);
        $dealerScore = $gameProcess->dealerTurn(['D1', 'DA'], 11);
        $this->assertSame(23, $dealerScore);
    }

}
