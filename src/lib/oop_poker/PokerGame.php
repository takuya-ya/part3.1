<?php

namespace OopPoker;

class PokerGame
{
    private const THREE_CARD_HAND = 3;
    // 引数：プレイヤーの手札[[H10,D10],[H11,D2]]
    public function __construct(private array $card1, private array $card2)
    {
    }

    public function start(): array
    {
        $hands = [];

        foreach ([$this->card1, $this->card2] as $cards) {
            $pokerCards = array_map(fn($card) => new PokerCard($card), $cards);

            //役を判定するルール選定
            $gotRule = $this->getRule($cards);

            // 手札情報作成を実行させる為のクラス
            $handEvaluator = $this->getHandEvaluatorRule($cards, $gotRule);

            // プレイヤーの手札情報の配列を格納
            $hands[] = $handEvaluator->getHand($pokerCards);
        }

        // 勝敗を判定するルールを選定し、勝者を判定
        $judgeRule = $this->getJudgeRule($this->card1);
        $winner = $judgeRule->getWinner($hands);

        return [$hands[0]['name'], $hands[1]['name'], $winner];
    }

    private function getHandEvaluatorRule(array $cards, PokerRule $gotRule): PokerHandEvaluator
    {
        return count($cards) === self::THREE_CARD_HAND
            ? new ThreeCardHandEvaluator($gotRule)
            : new TwoCardHandEvaluator($gotRule);
    }
    private function getRule(array $cards): PokerRule
    {
        return count($cards) === self::THREE_CARD_HAND ? new ThreePokerCardRule() : new TwoPokerCardRule();
    }

    private function getJudgeRule(array $cards): PokerJudgeRule
    {
        return count($cards) === self::THREE_CARD_HAND ? new ThreePokerJudgeRule() : new TwoPokerJudgeRule();
    }
}
// $game = new PokerGame(['CA', 'DA'], ['C9', 'H10']);
//             $game->start();
