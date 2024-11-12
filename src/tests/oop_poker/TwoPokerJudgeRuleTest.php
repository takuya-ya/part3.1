<?php

namespace OopPoker\Tests;

use PHPUnit\Framework\TestCase;
use OopPoker\TwoPokerJudgeRule;

require_once(__DIR__ . '/../../lib/oop_poker/TwoPokerJudgeRule.php');

class TwoPokerJudgeRuleTest extends TestCase
{
    public function testGetWinner()
    {
        $rule = new TwoPokerJudgeRule();
        $this->assertSame(2, $rule->getWinner([['name' => 'pair', 'hand rank' => 1, 'primary' => 9, 'secondly' => 9], ['name' => 'pair', 'hand rank' => 2, 'primary' => 8, 'secondly' => 9]]));
    }
}
