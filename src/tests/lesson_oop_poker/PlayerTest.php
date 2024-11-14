<?php

namespace LessonOopPoker\Tests;

use PHPUnit\Framework\TestCase;
use LessonOopPoker\Player;
use LessonOopPoker\Deck;

require_once(__DIR__ . '/../../lib/lesson_oop_poker/Player.php');

class PlayerTest extends TestCase
{
    public function testDrawCards()
    {
        $player = new Player('田中', 2);
        $deck = new Deck();
        $this->assertSame(2, count($player->drawCards($deck, 2)));
    }
}
