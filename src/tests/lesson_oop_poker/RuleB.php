<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/lesson_oop_poker/RuleB.php');
require_once(__DIR__ . '/../../lib/lesson_oop_poker/Card.php');

class RuleBTest extends TestCase
{
    public function testGetHand()
    {
        $rule = new RuleB();
        $cards = [new Card('H', 10), new Card('D', 10)];
        $this->assertSame('high card', $rule->getHand($cards));
    }
}
