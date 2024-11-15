<?php

namespace OopPoker\Tests;

use PHPUnit\Framework\TestCase;
use OopPoker\ThreePokerJudgeRule;

class ThreePokerJudgeRuleTest extends TestCase
{
    public function testGetWinner()
    {
        $rule = new ThreePokerJudgeRule();
        $this->assertSame(2, $rule->getWinner(
            [['name' => 'pair', 'hand rank' => 1, 'primary' => 9, 'secondly' => 9, 'thirdly' => 9],
            ['name' => 'pair', 'hand rank' => 2, 'primary' => 8, 'secondly' => 9]]
        ));

         // ハイカードのテスト
        $this->assertSame(2, $rule->getWinner(
            [['name' => 'high card', 'hand rank' => 1, 'primary' => 10, 'secondly' => 8, 'thirdly' => 4],
            ['name' => 'high card', 'hand rank' => 1, 'primary' => 12, 'secondly' => 7, 'thirdly' => 3]]
        ));

        // ペアのテスト
        $this->assertSame(1, $rule->getWinner(
            [['name' => 'pair', 'hand rank' => 2, 'primary' => 11, 'secondly' => 11, 'thirdly' => 9],
            ['name' => 'pair', 'hand rank' => 2, 'primary' => 10, 'secondly' => 10, 'thirdly' => 7]]
        ));

        // スリーカードのテスト
        $this->assertSame(2, $rule->getWinner(
            [['name' => 'three of a kind', 'hand rank' => 4, 'primary' => 9, 'secondly' => 9, 'thirdly' => 9],
            ['name' => 'three of a kind', 'hand rank' => 4, 'primary' => 10, 'secondly' => 10, 'thirdly' => 10]]
        ));

        // ストレート（最弱：A-2-3）のテスト
        $this->assertSame(2, $rule->getWinner(
            [['name' => 'straight', 'hand rank' => 3, 'primary' => 3, 'secondly' => 2, 'thirdly' => 1],
            ['name' => 'straight', 'hand rank' => 3, 'primary' => 5, 'secondly' => 4, 'thirdly' => 3]]
        ));

        // ストレート（最強：Q-K-A）のテスト
        $this->assertSame(1, $rule->getWinner(
            [['name' => 'straight', 'hand rank' => 3, 'primary' => 13, 'secondly' => 12, 'thirdly' => 11],
            ['name' => 'straight', 'hand rank' => 3, 'primary' => 10, 'secondly' => 9, 'thirdly' => 8]]
        ));

        // 同点（引き分け）のテスト
        $this->assertSame(0, $rule->getWinner(
            [['name' => 'pair', 'hand rank' => 2, 'primary' => 9, 'secondly' => 9, 'thirdly' => 5],
            ['name' => 'pair', 'hand rank' => 2, 'primary' => 9, 'secondly' => 9, 'thirdly' => 5]]
        ));
    }
}
