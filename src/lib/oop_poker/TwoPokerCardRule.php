<?php

namespace OopPoker;

require_once('PokerRule.php');
require_once('PokerCard.php');

class TwoPokerCardRule implements PokerRule
{
    private const HIGH_CARD = 'high card';
    private const PAIR = 'pair';
    private const STRAIGHT = 'straight';

    public function getHand(array $ranks)
    {
        $maxRanks = max($ranks);
        $minRanks = min($ranks);

        $hand = self::HIGH_CARD;
        if ($this->straight($maxRanks, $minRanks, $ranks)) {
            $hand = self::STRAIGHT;
        } elseif ($this->pair($maxRanks, $minRanks)) {
            $hand = self::PAIR;
        }
        return $hand;
    }

    private function straight(int $maxRanks, int $minRanks, array $ranks): bool
    {
        return ($maxRanks - $minRanks) === 1 || $this->maxMin($ranks);
    }

    // 引数が他の役判定のメソッドと異なるのは、他のクラスでも使用するため、後から変更している
    public function maxMin(array $ranks): bool
    {
        return (max($ranks) - min($ranks)) === (max(PokerCard::CARD_RANK) - min(PokerCard::CARD_RANK));
    }

    private function pair($maxRanks, $minRanks): bool
    {
        return ($maxRanks === $minRanks);
    }
}
