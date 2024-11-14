<?php

namespace LessonOopPoker\Tests;

use PHPUnit\Framework\TestCase;
use LessonOopPoker\Deck;

require_once(__DIR__ . '/../../lib/lesson_oop_poker/Deck.php');

class DeckTest extends TestCase
{
    public function testDrawCards()
    {
        $deck = new Deck();
        $cards = $deck->drawCards(2);
        $this->assertSame(2, count($cards));
    }
}
