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
        $deck = new Deck(new Card());
        $dealer = new Dealer();
        $playerNames = ['takuya'];
        $playerHands = $dealer->dealStartHands($deck, $playerNames);

        // プレイヤーの人数分の手札の有無
        $this->assertSame(count($playerNames), count($playerHands));
        // プレイヤーが2人の場合
        $playerNames = ['takuya', 'akemi'];
        $playerHands = $dealer->dealStartHands($deck, $playerNames);
        $this->assertSame(count($playerNames), count($playerHands));
        // プレイヤーが3人の場合
        $playerNames = ['takuya', 'akemi', 'kawasaki'];
        $playerHands = $dealer->dealStartHands($deck, $playerNames);
        $this->assertSame(count($playerNames), count($playerHands));
    }

    public function testMakeDealerHand()
    {
        $deck = new Deck(new Card());
        $dealer = new Dealer();

        // カードの枚数を確認
        $this->assertSame(2, count($dealer->makeDealerHand($deck)));
    }

    public function testDealAddCard()
    {
        $deck = new Deck(new Card());
        $dealer = new Dealer();

        // カードの枚数を確認
        $this->assertSame(1, count($dealer->dealAddCard($deck)));
    }
}
