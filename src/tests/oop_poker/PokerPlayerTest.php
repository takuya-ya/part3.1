<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/oop_poker/PokerPlayer.php');

class PokerPlayerTest extends TestCase
{
    public function testGetCardRank()
    {
        $player = new PokerPlayer([['A', 'A'], ['10', '10']]);
        $this->assertSame([[13, 13], [9, 9]] , $player->getCardRank());
    }
}
