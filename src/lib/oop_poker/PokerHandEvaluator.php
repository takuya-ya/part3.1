<?php

use function PokerGame\ThreeCard\isStraight;

require_once('PokerCard.php');

class PokerHandEvaluator
{
    public function __construct(private PokerRule $rule)
    {
    }

    public function getHand(array $pokerCards): string
    {
        return $this->rule->getHand($pokerCards);
    }
}