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

        $deckMock = $this->createMock(Deck::class);

        // Player インスタンスを実際に作成
        $player = new Player($dealerMock, $deckMock, 'takuya');
        $player->drawStartHand();
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
