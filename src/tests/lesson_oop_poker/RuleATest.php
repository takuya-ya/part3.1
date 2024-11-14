<?php

namespace LessonOopPoker\Tests;

use LessonOopPoker\RuleA;
use LessonOopPoker\Card;
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/lesson_oop_poker/RuleA.php');
require_once(__DIR__ . '/../../lib/lesson_oop_poker/Card.php');

class RuleATest extends TestCase
{
    public function testGetHand()
    {
        $rule = new RuleA();
        $cards = [new Card('H', 10), new Card('D', 10)];
        $this->assertSame('pair', $rule->getHand($cards));
    }
}
