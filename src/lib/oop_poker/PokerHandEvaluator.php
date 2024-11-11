<?php

namespace OopPoker;

use const PokerGame\ThreeCard\HAND_RANK;

require_once('PokerCard.php');

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

    public function getHand(array $pokerCards): string
    {
        return $this->rule->getHand($pokerCards);
    }
}
