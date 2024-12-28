<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\Game;

require_once(__DIR__ . '/../../lib/black_jack/Game.php');

class GameTest extends TestCase
{
    public function testStart()
    {
        $game = new Game('takuya');
        $playerCards = $game->start();
        // 型の確認
        $this->assertSame('array', gettype($playerCards));
        // 人数分の手札の確認
        $this->assertSame(2, count($playerCards));
        // 各プレイヤーの手札枚数の確認
        foreach($playerCards as $playerCard) {
        $this->assertSame(2, count($playerCard));
        }
    }
}
