<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\Card;

class CardTest extends TestCase
{
    public function testCardConstruct()
    {
        $card = new Card();
        $this->assertSame('S1', $card->cards[0]);
    }
}
