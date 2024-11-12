<?php

namespace OopPoker\Tests;

use PHPUnit\Framework\TestCase;
use OopPoker\ThreePokerJudgeRule;

require_once(__DIR__ . '/../../lib/oop_poker/ThreePokerJudgeRule.php');

class ThreePokerJudgeRuleTest extends TestCase
{
    public function testGetWinner()
    {
        $rule = new ThreePokerJudgeRule();
    }
}
