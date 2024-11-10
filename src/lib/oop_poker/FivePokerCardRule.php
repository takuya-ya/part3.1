<?php

require_once('PokerRule.php');
require_once('PokerCard.php');

class FivePokerCardRule implements PokerRule
{
    private const HIGH_CARD = 'high card';
    private const ONE_PAIR = 'one pair';
    private const TWO_PAIR = 'two pair';
    private const STRAIGHT = 'straight';
    private const THREE_OF_A_KIND = 'three of a kind';
    private const FOUR_OF_A_KIND = 'four of a kind';
    private const FULL_HOUSE = 'full house';

    public function getHand(array $pokerCards): string
    {
        $ranks = array_map(fn($cardRank) => $cardRank->getRank(), $pokerCards);
        sort($ranks);

        $hand = self::HIGH_CARD;
        if ($this->fullHouse($ranks)) {
            $hand = self::FULL_HOUSE;
        } elseif ($this->threeOfAKind($ranks)) {
            $hand = self::THREE_OF_A_KIND;
        } elseif ($this->straight($ranks)) {
            $hand = self::STRAIGHT;
        } elseif ($this->fourOfAKind($ranks)) {
            $hand = self::FOUR_OF_A_KIND;
        } elseif ($this->twoPair($ranks)) {
            $hand = self::TWO_PAIR;
        } elseif ($this->onePair($ranks)) {
            $hand = self::ONE_PAIR;
        }
        return $hand;
    }

    private function twoPair(array $ranks): bool
    {
        return (count(array_unique(array_slice($ranks, 0, 2))) === 1 && count(array_unique(array_slice($ranks, 2, 2))) === 1)
            || (count(array_unique(array_slice($ranks, 0, 2))) === 1 && count(array_unique(array_slice($ranks, 3, 2))) === 1)
            || (count(array_unique(array_slice($ranks, 1, 2))) === 1 && count(array_unique(array_slice($ranks, 3, 2))) === 1);
        }

    public function threeOfAKind(array $ranks): bool
    {
        $countRanks = array_count_values($ranks);
        return in_array(3, $countRanks);
        ;
    }

    private function fullHouse($ranks) {
        return (count(array_unique(array_slice($ranks, 0, 3))) === 1 && count(array_unique(array_slice($ranks, 3, 2))) === 1)
            || (count(array_unique(array_slice($ranks, 0, 2))) === 1 && count(array_unique(array_slice($ranks, 2, 3))) === 1);
    }

    private function fourOfAKind($ranks) {
        return count(array_unique(array_slice($ranks, 0, 4))) === 1 || count(array_unique(array_slice($ranks, 1, 4))) === 1;
    }

    private function onePair(array $ranks): bool {
        return count(array_unique($ranks)) === 4;
    }

    private function straight(array $ranks): bool
    {
        return range($ranks[0], $ranks[0] + count($ranks) - 1) === $ranks || $this->maxMin($ranks);
    }
    private function maxMin(array $ranks): bool
    {
        return $ranks === [min(PokerCard::CARD_RANK), min(PokerCard::CARD_RANK) + 1, min(PokerCard::CARD_RANK) + 2, min(PokerCard::CARD_RANK) + 3, max(PokerCard::CARD_RANK)];}
}
