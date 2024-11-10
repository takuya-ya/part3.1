<?php

namespace OopPoker;

require_once('PokerRule.php');
require_once('PokerCard.php');

class TwoPokerCardRule implements PokerRule
{
    private const HIGH_CARD = 'high card';
    private const PAIR = 'pair';
    private const STRAIGHT = 'straight';

    public function getHand(array $pokerCards)
    {
        $ranks = array_map(fn($cardRank) => $cardRank->getRank(), $pokerCards);

        $maxRanks = max($ranks);
        $minRanks = min($ranks);

        $hand = self::HIGH_CARD;
        if ($this->straight($maxRanks, $minRanks))
        {
            $hand = self::STRAIGHT;
        } elseif ($this->pair($maxRanks, $minRanks))
        // 13-2
        {
            $hand = self::PAIR;
        }
        return $hand;
    }

    private function straight($maxRanks, $minRanks): bool
    {
        // 13-2
        // 13 12
        return ($maxRanks - $minRanks) === 1 || $this->maxMin($maxRanks, $minRanks);
    }

    private function maxMin($maxRanks, $minRanks): bool
    {
        return ($maxRanks - $minRanks) === (max(PokerCard::CARD_RANK) - min(PokerCard::CARD_RANK));
    }

    private function pair($maxRanks, $minRanks): bool
    {
        return ($maxRanks === $minRanks);
    }

}
