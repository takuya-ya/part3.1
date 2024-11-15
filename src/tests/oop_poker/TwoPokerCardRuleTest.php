<?php

namespace OopPoker\Tests;

use PHPUnit\Framework\TestCase;
use OopPoker\TwoPokerCardRule;

class TwoPokerCardRuleTest extends TestCase
{
    public function testGetHand()
    {
        $rule = new TwoPokerCardRule();
        $this->assertSame('high card', $rule->getHand([10, 8]));
    }
}
