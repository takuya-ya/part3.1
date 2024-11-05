<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/oop_poker/PokerCard.php');

class PokerCardTest extends TestCase
{
    public function testPokerCard()
    {
        $game = new PokerCard('H10');
        $this->assertSame(9, $game->getRank());
    }
}
