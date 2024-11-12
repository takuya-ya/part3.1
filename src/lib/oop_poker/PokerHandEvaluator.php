<?php

namespace OopPoker;


require_once('TwoPokerCardRule.php');

class PokerHandEvaluator
{
    private const HAND_RANK = [
        'high card' => 1,
        'pair' => 2,
        'straight' => 3
    ];

    public function __construct(private PokerRule $rule)
    {
    }

    public function getHand(array $pokerCards): array
    {
        // ランク[10,9]
        $ranks = array_map(fn($cardRank) => $cardRank->getRank(), $pokerCards);
        $hand = $this->rule->getHand($ranks);
        max($ranks);

        // 手札がA,2 = rank:12, 1の場合 ルールに基づき、primaryに1,secondlyに12を代入
        if($this->rule->maxMin($ranks)) {
            $ranks[0] = min(PokerCard::CARD_RANK);
            $ranks[1] = max(PokerCard::CARD_RANK);
        }
        return ['name' => $hand, 'hand rank' => self::HAND_RANK[$hand], 'primary' => $ranks[0], 'secondly' => $ranks[1]];
    }
}
$handEvaluator = new PokerHandEvaluator(new TwoPokerCardRule);
$handEvaluator->getHand([new PokerCard('H10'), new PokerCard('H10')]);
