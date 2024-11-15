<?php

namespace OopPoker\Tests;

use PHPUnit\Framework\TestCase;
use OopPoker\PokerCard;

class PokerCardTest extends TestCase
{
    public function testPokerCard()
    {
        $game = new PokerCard('H10');
        $this->assertSame(9, $game->getRank());
    }
}
