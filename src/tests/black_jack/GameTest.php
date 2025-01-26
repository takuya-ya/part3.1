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
    public function testStart()
    {
        $card = new Card;
        $deck = new Deck($card);
        $dealer = new Dealer($deck);
        $pointCalculator = new PointCalculator;
        $gameProcess = new GameProcess($dealer, $deck, $pointCalculator);
        $game = new Game($deck, $gameProcess, $dealer, $pointCalculator, ['takuya'], 'takuya');
        $this->assertSame('ブラックジャックを終了します。', $game->start());
    }
}
