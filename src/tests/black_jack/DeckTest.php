<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\Deck;
use BlackJack\Card;

require_once(__DIR__ . '/../../lib/black_jack/Deck.php');
require_once(__DIR__ . '/../../lib/black_jack/Card.php');

class DeckTest extends TestCase
{
    public function testMakeDeck()
    {
        $deck = new Deck(new Card);
        $shuffledDeck = $deck->makeDeck();
        $this->assertSame(52, count($shuffledDeck));
        $this->assertSame(count($shuffledDeck), count(array_unique($shuffledDeck)));
        $this->assertEqualsCanonicalizing($deck->card->cards, $shuffledDeck);
    }

    public function testDrawCard()
    {
        $deck = new Deck(new Card);
        $playerCards = $deck->drawCard();

        // 型の確認
        $this->assertSame('array', gettype($playerCards));
        // プレイヤー人数1名とディーラーの手札の有無を確認
        // TODO:拡張対応、人数が増える場合の対応
        $this->assertSame(2, count($playerCards));
        // 1人2枚ずつ、カード有無を確認
        $this->assertSame(2, count($playerCards[0]));
        $this->assertSame(2, count($playerCards[1]));
        // 重複チェック:全プレイヤーの手札カードを配列に格納して重複チェック
        // TODO:拡張対応、人数が増える場合の対応
        foreach ($playerCards as $playerCard){
            foreach ($playerCard as $card)
            $checkCards[] = $card;
        }
        $this->assertSame(4, count(array_unique($checkCards)));
    }
}
