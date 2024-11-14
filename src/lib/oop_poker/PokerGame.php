<?php

namespace OopPoker;

require_once('PokerPlayer.php');
require_once('PokerRule.php');
require_once('PokerHandEvaluator.php');
require_once('lib/oop_poker/TwoPokerJudgeRule.php');
require_once('TwoPokerCardRule.php');
require_once('TwoCardHandEvaluator.php');

class PokerGame
{
    // 引数：プレイヤーの手札[[H10,D10],[H11,D2]]
    public function __construct(private array $card1, private array $card2)
    {
    }

    public function start(): array
    {
        $hands = [];
        //[[H10,D10],[H11,D2]] => [H10,D10]
        foreach ([$this->card1, $this->card2] as $cards) {
            //各カードのインスタンス作成し、配列化
            // $pokerCards [new PokerCard(H10),new PokerCard(H10)] = H10 => インスタンス(H10)
            $pokerCards = array_map(fn($card) => new PokerCard($card), $cards);

            // 修正：単一責任になっていないので削除
            // カードの数字を抽出して、配列化
            // $cardNumbers[] = array_map(fn($playerCard) => substr($playerCard, 1), $playerCards);

            //役を判定するルール選定
            $gotRule = $this->getRule($cards);

            // 手札情報作成を実行させる為のクラス
            // 引数：選定されたルール。
            $handEvaluator = $this->getHandEvaluatorRule($cards, $gotRule);

            // プレイヤーの手札情報の配列を格納
            $hands[] = $handEvaluator->getHand($pokerCards);
        }

        // 勝敗を判定するルールを選定
        // 引数　カードの枚数
        $judgeRule = $this->getJudgeRule($cards);

        // ルールに基づいて、勝者を判定
        // 引数：両プレイヤーの手札情報
        $winner = $judgeRule->getWinner($hands);

        // カードの枚数に応じて勝者判定ルールのインスタンス取得
        // そのインスタンスにgetWinnerさせるクラスを設定（勝者判定はGameでは行わないという事）
        return [$hands[0]['name'], $hands[1]['name'], $winner];
    }

    private function getHandEvaluatorRule(array $cards, PokerRule $gotRule): PokerHandEvaluator
    {
        return count($cards) === 3 ? new ThreeCardHandEvaluator($gotRule) : new TwoCardHandEvaluator($gotRule);
    }
    private function getRule(array $cards): PokerRule
    {
        return count($cards) === 3 ? new ThreePokerCardRule() : new TwoPokerCardRule();
    }

    private function getJudgeRule(array $cards): PokerJudgeRule
    {
        return count($cards) === 3 ? new ThreePokerJudgeRule() : new TwoPokerJudgeRule();
    }
}
// $game = new PokerGame(['CA', 'DA'], ['C9', 'H10']);
//             $game->start();
