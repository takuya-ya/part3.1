<?php

namespace OopPoker\Tests;
use OopPoker\PokerHandEvaluator;
use OopPoker\TwoPokerCardRule;
use OopPoker\PokerCard;

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/oop_poker/PokerHandEvaluator.php');

class PokerHandEvaluatorTest extends TestCase
{
    public function testGetHand()
    {
        $handEvaluator = new PokerHandEvaluator(new TwoPokerCardRule());
        $this->assertSame(['name' => 'pair', 'hand rank' => 2, 'primary' => 9, 'secondly' => 9], $handEvaluator->getHand([new PokerCard('H10'), new PokerCard('H10')]));
        $handEvaluator = new PokerHandEvaluator(new TwoPokerCardRule());
        $this->assertSame(['name' => 'high card', 'hand rank' => 1, 'primary' => 9, 'secondly' => 1], $handEvaluator->getHand([new PokerCard('H10'), new PokerCard('H2')]));
        $handEvaluator = new PokerHandEvaluator(new TwoPokerCardRule());
        $this->assertSame(['name' => 'straight', 'hand rank' => 3, 'primary' => 9, 'secondly' => 8], $handEvaluator->getHand([new PokerCard('H10'), new PokerCard('H9')]));
        $handEvaluator = new PokerHandEvaluator(new TwoPokerCardRule());
        $this->assertSame(['name' => 'straight', 'hand rank' => 3, 'primary' => 1, 'secondly' => 13], $handEvaluator->getHand([new PokerCard('HA'), new PokerCard('H2')]));
    }
}
