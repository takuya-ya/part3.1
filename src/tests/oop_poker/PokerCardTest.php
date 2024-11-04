<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/oop_poker/PokerCard.php');

class PokerCardTest extends TestCase
{
    public function testPokerCard()
    {
        $game = new PokerCard([['A', 'A'], ['10', '10']]);
        $this->assertSame([[13, 13], [9, 9]] , $game->getRank());
    }
}
