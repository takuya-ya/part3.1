<?php

namespace OopPoker\Tests;

use OopPoker\ThreePokerCardRule;
use OopPoker\ThreeCardHandEvaluator;
use OopPoker\PokerCard;
use PHPUnit\Framework\TestCase;

class ThreeCardHandEvaluatorTest extends TestCase
{
    public function testGetHand()
    {
        $handEvaluator = new ThreeCardHandEvaluator(new ThreePokerCardRule());
        $this->assertSame(
            ['name' => 'pair', 'hand rank' => 2, 'primary' => 9, 'secondly' => 9, 'thirdly' => 6],
            $handEvaluator->getHand([new PokerCard('H10'), new PokerCard('D10'), new PokerCard('H7')])
        );

        $this->assertSame(
            ['name' => 'high card', 'hand rank' => 1, 'primary' => 12, 'secondly' => 9, 'thirdly' => 4],
            $handEvaluator->getHand([new PokerCard('HK'), new PokerCard('D10'), new PokerCard('S5')])
        );

        // ペアのテスト
        $this->assertSame(
            ['name' => 'pair', 'hand rank' => 2, 'primary' => 9, 'secondly' => 9, 'thirdly' => 6],
            $handEvaluator->getHand([new PokerCard('H10'), new PokerCard('D10'), new PokerCard('H7')])
        );

        // スリーカードのテスト
        $this->assertSame(
            ['name' => 'three of a kind', 'hand rank' => 4, 'primary' => 9, 'secondly' => 9, 'thirdly' => 9],
            $handEvaluator->getHand([new PokerCard('H10'), new PokerCard('D10'), new PokerCard('S10')])
        );

        // ストレート（最弱：A-2-3）のテスト
        $this->assertSame(
            ['name' => 'straight', 'hand rank' => 3, 'primary' => 2, 'secondly' => 13, 'thirdly' => 1],
            $handEvaluator->getHand([new PokerCard('HA'), new PokerCard('H2'), new PokerCard('H3')])
        );

        // ストレート（最強：Q-K-A）のテスト
        $this->assertSame(
            ['name' => 'straight', 'hand rank' => 3, 'primary' => 13, 'secondly' => 12, 'thirdly' => 11],
            $handEvaluator->getHand([new PokerCard('HQ'), new PokerCard('HK'), new PokerCard('HA')])
        );
    }
}
