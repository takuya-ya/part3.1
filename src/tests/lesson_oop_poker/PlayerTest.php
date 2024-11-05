<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/lesson_oop_poker/Player.php');

class PlayerTest extends TestCase
{
    public function testDrawCards()
    {
        $player = new Player('田中');
        $this->assertSame(2, count($player->drawCards()));
    }
}
