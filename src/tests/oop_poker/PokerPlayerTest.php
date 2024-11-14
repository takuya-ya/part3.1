<?php

namespace OopPoker\Tests;

use PHPUnit\Framework\TestCase;
use OopPoker\PokerPlayer;
use OopPoker\PokerCard;

require_once(__DIR__ . '/../../lib/oop_poker/PokerPlayer.php');
require_once(__DIR__ . '/../../lib/oop_poker/PokerCard.php');

class PokerPlayerTest extends TestCase
{
    public function testGetCardRank()
    {
        $player = new PokerPlayer([new PokerCard('H10'), new PokerCard('D10')]);
        $this->assertSame([9, 9], $player->getCardRank());
    }
}
