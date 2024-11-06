<?php

require_once('PokerPlayer.php');
require_once('PokerHandEvaluator.php');

class PokerGame
{
    // [[H10,D10],[H11,D2]]
    public function __construct(private array $card1, private array $card2)
    {
    }

    public function start(): array
    {
        $cardRanks = [];
        $hands = [];
        //[[H10,D10],[H11,D2]] => [H10,D10]
        // foreach内で扱うのは、player１人のカードを扱う
        foreach ([$this->card1, $this->card2] as $cards) {
            //各カードのインスタンス作成し、配列化
            // H10 => インスタンス(H10) ,[H10,D10]
            // $pokerCards [new PokerCard(H10),new PokerCard(H10)]
            $pokerCards = array_map(fn($card) => new PokerCard($card), $cards);

                // 修正：単一責任になっていないので削除
                // カードの数字を抽出して、配列化
                // $cardNumbers[] = array_map(fn($playerCard) => substr($playerCard, 1), $playerCards);

            $player = new PokerPlayer($pokerCards);
            $cardRanks[] = $player->getCardRank();
            // 役を判定
            // コンストはインスタンス受けれるっけ？
            $handEvaluator = new PokerHandEvaluator();
            $hands[] = $handEvaluator->getHand($pokerCards);

        }
        return $hands;

        // カードの数字をランクに変換
        // 引数はカードペアのインスタンス（１人分のカード）を渡してプレイヤー一人作成
    }
}

$game = new PokerGame(['CA', 'DA'], ['C10', 'H10']);
$game->start();
// $this->start();
