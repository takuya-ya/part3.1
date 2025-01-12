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
        $deck->makeDeck();
        $drawnCard = $deck->drawCard(2);

        // カードの枚数を確認
        $this->assertSame(2, count($drawnCard));
        //　引いたカードが山札から削除されているか確認
        $this->assertSame(false, in_array($drawnCard[0], $deck->cardDeck));
        $this->assertSame(false, in_array($drawnCard[1], $deck->cardDeck));
    }

}
