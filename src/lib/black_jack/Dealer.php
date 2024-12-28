<?php
namespace BlackJack;

use BlackJack\Deck;

require_once(__DIR__.'/Deck.php');

class Dealer
{
    public array $dealerCard = [];
    public function dealingCard(string $playerName): array
    {
        $playerNames = ["$playerName", 'dealer'];
        $playerCards = [];
        // TODO:プレイヤー数増加への対応追加
        // インデント番号が最後の手札はdearlerの手札配列とする
        $indent = 0;
        // カードを山札から引く処理
        $deck = new Deck;
        $collectionTwoCards = $deck->drawCard();
        // $playersCard配列のキーにプレイヤー名を追加し、プレイヤーと手札を紐づける
        foreach ($collectionTwoCards as $TwoCards) {
           
            $playerCards[$playerNames[$indent]] = $TwoCards;
            ++$indent;
        }
        return $playerCards;
    }
}
