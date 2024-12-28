<?php
namespace BlackJack;

use BlackJack\Deck;

require_once(__DIR__.'/Deck.php');

class Dealer
{
    public array $dealerCard = [];
    public function dealingCard(): array
    {
        // TODO:$playerName仮実装。本実装では、dealingCardの引数に設定すること。
        $playerName = ['takuya', 'dealer'];

        $playersCard = [];
        // TODO:プレイヤー数増加への対応追加
        // インデント番号が最後の手札はdearlerの手札配列とする
        $indent = 0;
        // カードを山札から引く処理
        $deck = new Deck;
        $collectionTwoCards = $deck->drawCard();
        // $playersCard配列のキーにプレイヤー名を追加し、プレイヤーと手札を紐づける
        foreach ($collectionTwoCards as $TwoCards) {
            // TODO:dealerへのカードを渡す方法が確定次第、if文削除
            // if (count($playersCard) - count($playerName) === 0 ) {
            //     $dealerCard = $TwoCards;
            //     break;
            // }
            $playersCard[$playerName[$indent]] = $TwoCards;
            ++$indent;
        }
        return $playersCard;
    }
}
$i = new Dealer;
$i->dealingCard(['takuya']);
