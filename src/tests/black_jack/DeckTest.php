<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\Deck;

require_once(__DIR__ . '/../../lib/black_jack/Deck.php');

class DeckTest extends TestCase
{
    public function testDrawCard()
    {
        $deck = new Deck;
        $card = $deck->drawCard();
        $this->assertSame('S2', $card);
    }
}
