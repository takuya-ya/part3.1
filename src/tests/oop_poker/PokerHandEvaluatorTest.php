<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/oop_poker/PokerHandEvaluator.php');

class PokerHandEvaluatorTest extends TestCase
{
    public function testGetHand()
    {
        $handEvaluator = new PokerHandEvaluator();
        $this->assertSame('pair', $handEvaluator->getHand([new PokerCard('H10'), new PokerCard('H10')]));
        $handEvaluator = new PokerHandEvaluator();
        $this->assertSame('high card', $handEvaluator->getHand([new PokerCard('H10'), new PokerCard('H2')]));
        $handEvaluator = new PokerHandEvaluator();
        $this->assertSame('straight', $handEvaluator->getHand([new PokerCard('H10'), new PokerCard('H9')]));
    }
}
