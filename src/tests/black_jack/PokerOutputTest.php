<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\PokerOutput;

class PokerOutputTest extends TestCase
{
    public function testDisplayPlayerCard()
    {
        $this->expectOutputString(
            "あなたの引いたカードは0です。" . PHP_EOL .
            "あなたの引いたカードは1です。" . PHP_EOL
        );
        $pokerOutput = new PokerOutput();
        $pokerOutput->displayPlayerCard(['takuya' => [0, 1]], ['takuya']);
    }
}
