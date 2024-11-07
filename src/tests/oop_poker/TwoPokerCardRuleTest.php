<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/oop_poker/TwoPokerCardRule.php');

class TwoPokerCardRuleTest extends TestCase
{
    public function testTwoPokerCardRule()
    {
        $rule = new TwoPokerCardRule();
        $this->assertSame('high card', $rule->getHand([new PokerCard('H10'), new PokerCard('H8')]));
    }
}
