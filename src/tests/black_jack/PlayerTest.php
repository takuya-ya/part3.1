<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\Player;

require_once(__DIR__ . '/../../lib/black_jack/Player.php');

class PlayerTest extends TestCase
{
    public function testReceiveCard()
    {
        $player = new Player('takuya');
        $playerCard = $player->receiveCard(['takuya' => ['H2', 'H5']]);
        $this->assertSame(['H2', 'H5'], $playerCard);
    }
}
