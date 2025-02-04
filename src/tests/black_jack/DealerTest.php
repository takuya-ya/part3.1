<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\Dealer;
use BlackJack\Deck;
use BlackJack\Card;

class DealerTest extends TestCase
{
    public function testDealStartCard()
    {
        $expectedCards = ['K1', 'D1'];
        $deckMock = $this->createMock(Deck::class);
        $deckMock->expects($this->once())
                ->method('drawCard')
                ->with(2)
                ->willReturn($expectedCards);

        $dealer = new Dealer();
        $result = $dealer->dealStartHands($deckMock);

        // カードの枚数を確認
        $this->assertSame($expectedCards, $result);
    }

    // TODO 不要な場合は削除
    // public function testMakeDealerHand()
    // {
    //     $deck = new Deck(new Card());
    //     $dealer = new Dealer();

    //     // カードの枚数を確認
    //     $this->assertSame(2, count($dealer->makeDealerHand($deck)));
    // }

    public function testDealAddCard()
    {
        $deck = new Deck(new Card());
        $dealer = new Dealer();

        // カードの枚数を確認
        $this->assertSame(1, count($dealer->dealAddCard($deck)));
    }
}
