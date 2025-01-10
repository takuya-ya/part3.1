<?php
namespace BlackJack;

use BlackJack\Deck;

require_once(__DIR__.'/Deck.php');

class Dealer
{
    public array $dealerCard = [];
    // passCardインターフェースを引数にして依存性注入
    // passCardインターフェースはデッキ交換の拡張に対応できるよう作成
    // $cardNumで引きたいカード枚数を渡す
    public function drawCard(passCard $deck): array {
        $drawCard = $deck->drawCard($cardNum);
        // 引いたカードは山札から削除
        // 山札はGameクラスのプロパテぃにする


    }

    // $playerNamesにはdealerも格納済み
    public function drawCardsForPlayer(array $playerNames, Deck $deck): array
    {
        $playerCards = [];
        // TODO:プレイヤー数増加への対応追加
        // インデント番号が最後の手札はdearlerの手札配列とする
        $indent = 0;
        // カードを山札から引く処理
        $collectionTwoCards = $deck->drawCard();
        // $playersCard配列のキーにプレイヤー名を追加し、プレイヤーと手札を紐づける
        foreach ($collectionTwoCards as $TwoCards) {
            $playerCards[$playerNames[$indent]] = $TwoCards;
            ++$indent;
        }
        return $playerCards;
    }

    public function dealingCard(array $playerNames, Deck $deck): array
    {
        $playerCards = $this->drawCardsForPlayer($playerNames, $deck);
        return $playerCards;
    }
}
