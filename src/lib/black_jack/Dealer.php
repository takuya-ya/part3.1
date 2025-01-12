<?php
namespace BlackJack;

use BlackJack\Deck;

require_once(__DIR__.'/Deck.php');

class Dealer
{
    public array $dealerCard = [];

    public function dealStartHands(Deck $deck, array $playerNames) : array
    {
        $playerHands = $deck->startHands($playerNames);
        return $playerHands;
    }

    // // $playerNamesにはdealerも格納済み
    // public function drawCardsForPlayer(array $playerNames, Deck $deck): array
    // {
    //     $playerCards = [];
    //     // TODO:プレイヤー数増加への対応追加
    //     // インデント番号が最後の手札はdearlerの手札配列とする
    //     $indent = 0;
    //     // カードを山札から引く処理
    //     $collectionTwoCards = $deck->drawCard();
    //     // $playersCard配列のキーにプレイヤー名を追加し、プレイヤーと手札を紐づける
    //     foreach ($collectionTwoCards as $TwoCards) {
    //         $playerCards[$playerNames[$indent]] = $TwoCards;
    //         ++$indent;
    //     }
    //     return $playerCards;
    // }

    // public function dealingCard(array $playerNames, Deck $deck): array
    // {
    //     $playerCards = $this->drawCardsForPlayer($playerNames, $deck);
    //     return $playerCards;
    // }
}
