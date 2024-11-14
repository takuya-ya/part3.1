<?php

namespace LessonOopPoker\Tests;

use PHPUnit\Framework\TestCase;
use LessonOopPoker\Game;

require_once(__DIR__ . '/../../lib/lesson_oop_poker/Game.php');

class GameTest extends TestCase
{
    public function testStart()
    {
        $game = new Game('卓也', 2, 'A');
        $result = $game->start();
        $this->assertSame('pair', $result);
    }
}
