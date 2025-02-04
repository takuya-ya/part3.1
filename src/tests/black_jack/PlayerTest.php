<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\Player;
use BlackJack\Dealer;
use BlackJack\Deck;
use BlackJack\Card;


class PlayerTest extends TestCase
{

    public function testGetHand()
    {
        $expectedCards = ['K1', 'D1'];
        $dealerMock = $this->createMock(Dealer::class);
        $dealerMock->expects($this->once())
                ->method('dealStartHands')
                ->willReturn($expectedCards);

        $player = new Player($dealerMock, new Deck(new Card), 'takuya');
        $this->assertSame($expectedCards, $player->getHand());
    }

        // TODO：要修正
    // public function testAddCard()
    // {
    //     $player = new Player('takuya');
    //     $dealer = new Dealer();
    //     $deck = new Deck(new Card());
    //     $playerCard = $player->addCard($dealer, $deck, ['H2', 'H5']);
    //     $this->assertSame(3, count($playerCard));
    // }
}
