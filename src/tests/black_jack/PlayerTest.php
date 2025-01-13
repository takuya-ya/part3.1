<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\Player;
use BlackJack\Dealer;
use BlackJack\Deck;
use BlackJack\Card;

require_once(__DIR__ . '/../../lib/black_jack/Card.php');
require_once(__DIR__ . '/../../lib/black_jack/Dealer.php');
require_once(__DIR__ . '/../../lib/black_jack/Deck.php');
require_once(__DIR__ . '/../../lib/black_jack/Player.php');

class PlayerTest extends TestCase
{
    public function testAddCard()
    {
        $player = new Player('takuya');
        $dealer = new Dealer;
        $deck = new Deck(new Card);
        $playerCard = $player->addCard($dealer, $deck, ['H2', 'H5']);
        $this->assertSame(3, count($playerCard));
    }
}
