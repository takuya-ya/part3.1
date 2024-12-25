<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\Card;

require_once(__DIR__ . '/../../lib/black_jack/Card.php');

class CardTest extends TestCase
{
    public function testCardConstruct()
    {
        $card = new Card();
        $this->assertSame('S1', $card->cards[0]);
    }
}
