<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\Player;
use BlackJack\Dealer;
use BlackJack\Deck;
use BlackJack\Card;


class PlayerTest extends TestCase
{

    // 現状、drawStartHand()のテストも兼ねている状態。
    public function testGetHand()
    {
        $expectedCards = ['K1', 'D1'];
         // Dealer のモックを作成
        $dealerMock = $this->createMock(Dealer::class);
        $dealerMock->method('dealStartHands')
                   ->willReturn($expectedCards); // Dealer がカードを渡すと仮定

        // Player インスタンスを実際に作成
        $player = new Player($dealerMock, 'takuya');
        $player->drawStartHand();
        $this->assertSame($expectedCards, $player->getHand());
    }

    public function testAddCard()
    {
        $player = new Player(new Dealer(new Deck(new Card)), 'takuya');
        $playerCard = $player->addCard();
        $this->assertSame(3, count($playerCard));
    }
}
