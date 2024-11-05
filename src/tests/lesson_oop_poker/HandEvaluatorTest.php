<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/lesson_oop_poker/HandEvaluator.php');
require_once(__DIR__ . '/../../lib/lesson_oop_poker/RuleA.php');
require_once(__DIR__ . '/../../lib/lesson_oop_poker/Card.php');


class HandEvaluatorTest extends TestCase
{
    public function testGetHand()
    {
        $handEvaluator = new HandEvaluator(new RuleA());
        // Q　ここが体感不足
        // A　今の段階では想起しづらいが、rule->getHand()でgetSuitとgetNumを使用して手札を作る
        $cards = [new Card('H', 10), new Card('D', 10)];
        $this->assertSame('pair', $handEvaluator->getHand($cards));
    }
}
