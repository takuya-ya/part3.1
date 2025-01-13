<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\Dealer;
use BlackJack\Deck;
use BlackJack\Card;

require_once(__DIR__ . '/../../lib/black_jack/Dealer.php');
require_once(__DIR__ . '/../../lib/black_jack/Deck.php');
require_once(__DIR__ . '/../../lib/black_jack/Card.php');

class DealerTest extends TestCase
{
    public function testDealStartCard() {
        $deck = new Deck(new Card);
        $dealer = new Dealer;
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

    public function tesMakeDealerHand() {
        $deck = new Deck(new Card);
        $dealer = new Dealer;

        // カードの枚数
        $this->assertSame(2, $dealer->makeDealerHand($deck));
    }

    // public function testDrawCardForPlayer()
    // {
    //     $mockDeck = $this->createMock(Deck::class);
    //     $mockDeck->method('drawCard')->willReturn([
    //         ["H1", "D1"],
    //         ["H2", "D2"]
    //     ]);
    //     // print_r($mockDeck->drawCard());

    //     $dealer = new Dealer;
    //     $playerCard = $dealer->drawCardsForPlayer(['takuya', 'dealer'], $mockDeck);
    //     $this->assertSame(['H1', 'D1'], $playerCard['takuya']);
    // }

    // public function testDealingCard()
    // {
    //     $mockDeck = $this->createMock(Deck::class);
    //     $mockDeck->method('drawCard')->willReturn([
    //         ["H1", "D1"],
    //         ["H2", "D2"]
    //     ]);

    //     // print_r($mockDeck->drawCard());
    //     $dealer = new Dealer;
    //     // プレイヤー達のカードの手札が格納された配列を返す
    //     // $playersCard[名前]=各プレイヤーのカード
    //     $playersCard = $dealer->dealingCard(['takuya','dealer'], $mockDeck);
    //     // 型の確認
    //     $this->assertSame('array', gettype($playersCard));
    //     // 人数分の手札の確認
    //     $this->assertSame(2, count($playersCard));
    //     // 各プレイヤーの手札枚数の確認
    //     foreach($playersCard as $playerCard) {
    //     $this->assertSame(2, count($playerCard));
    //     // プレイヤーとカードが正常に紐づけられているかの確認
    //     $this->assertSame(["H1", "D1"], $playersCard['takuya']);
    //     $this->assertSame(["H2", "D2"], $playersCard['dealer']);
    //     }
    // }
}
