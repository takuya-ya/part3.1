<?php

namespace OopPoker\Tests;

use PHPUnit\Framework\TestCase;
use OopPoker\PokerGame;

require_once(__DIR__ . '/../../lib/oop_poker/PokerGame.php');

class PokerGameTest extends TestCase
{
    public function testStart()
    {
        // カードが3枚の場合
        $game = new PokerGame(['CA', 'DA'], ['C9', 'H10']);
        $this->assertSame(['pair', 'straight', 2], $game->start());

        // カードが3枚の場合
        $game2 = new PokerGame(['C2', 'D2', 'S2'], ['C10', 'H9', 'DJ']);
        $this->assertSame(['three of a kind', 'straight', 1], $game2->start());
    }
}
