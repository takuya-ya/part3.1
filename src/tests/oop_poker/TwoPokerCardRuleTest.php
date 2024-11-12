<?php

namespace OopPoker\Tests;

use PHPUnit\Framework\TestCase;
use OopPoker\TwoPokerCardRule;

require_once(__DIR__ . '/../../lib/oop_poker/TwoPokerCardRule.php');

class TwoPokerCardRuleTest extends TestCase
{
    public function testGetHand()
    {
        $rule = new TwoPokerCardRule();
        $this->assertSame('high card', $rule->getHand([10, 8]));
    }
}
