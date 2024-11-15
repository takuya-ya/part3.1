<?php

namespace OopPoker;

use OopPoker\ThreePokerCardRule;

class ThreeCardHandEvaluator implements PokerHandEvaluator
{
    private const HAND_RANK = [
        'high card' => 1,
        'pair' => 2,
        'straight' => 3,
        'three of a kind' => 4
    ];

    public function __construct(private PokerRule $rule)
    {
    }

    // 引数：カードインスタンスの配列
    public function getHand(array $pokerCards): array
    {
        // ランク[10,9]
        $ranks = array_map(fn($cardRank) => $cardRank->getRank(), $pokerCards);
        // ルールインスタンスにgetHandメソッドを実行させる
        // 役名を取得
        // 引数：$ranks(int)を誤って渡してエラー。対応に40m。
        $hand = $this->rule->getHand($pokerCards);

        rsort($ranks);
        // 手札がA,2,3 = mas(rank):12, 2, 1の場合 ルールに基づき、primaryに1,secondlyに12を代入
        if ($this->rule->maxMin($ranks)) {
            $ranks[0] = $ranks[1];
            $ranks[1] = max(PokerCard::CARD_RANK);
            $ranks[2] = min(PokerCard::CARD_RANK);
        }
        return ['name' => $hand, 'hand rank' => self::HAND_RANK[$hand],
        'primary' => $ranks[0], 'secondly' => $ranks[1], 'thirdly' => $ranks[2]];
    }
}
        $handEvaluator = new ThreeCardHandEvaluator(new ThreePokerCardRule());
        $handEvaluator->getHand([new PokerCard('H10'), new PokerCard('D10'), new PokerCard('H7')]);
