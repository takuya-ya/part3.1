<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/oop_poker/PokerPlayer.php');

class PokerPlayerTest extends TestCase
{
    public function testConvertToNum()
        {
            $card1 = new PokerPlayer(['CA', 'DA']);
            $this->assertSame([13, 13], $card1->convertToNum());
            $card2 = new PokerPlayer(['C10', 'H10']);
            $this->assertSame([9, 9], $card2->convertToNum());
        }
}
