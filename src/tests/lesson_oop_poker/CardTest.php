<?php

namespace LessonOopPoker\Tests;

use PHPUnit\Framework\TestCase;
use LessonOopPoker\Card;

require_once(__DIR__ . '/../../lib/lesson_oop_poker/Card.php');

class CardTest extends TestCase
{
    public function testGetSuit()
    {
        $card = new Card('H', '10');
        $cards = $card->getSuit();
        $this->assertSame('H', $cards);
    }

    public function testGetNum()
    {
        $card = new Card('H', '10');
        $cards = $card->getNumber();
        $this->assertSame(10, $cards);
    }
}
