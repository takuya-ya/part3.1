<?php

namespace OopPoker;

require_once('PokerRule.php');
require_once('PokerCard.php');

class ThreePokerCardRule implements PokerRule
{
    private const HIGH_CARD = 'high card';
    private const PAIR = 'pair';
    private const STRAIGHT = 'straight';
    private const THREE_OF_A_KIND = 'three of a kind';

    public function getHand(array $pokerCards): string
    {
        $ranks = array_map(fn($cardRank) => $cardRank->getRank(), $pokerCards);


        $hand = self::HIGH_CARD;
        // pairの方が出やすいのでそれを先に条件すべき、不要な処理を避けるため
        if ($this->threeOfAKind($ranks)) {
            // 13-2
            $hand = self::THREE_OF_A_KIND;
        } elseif ($this->straight($ranks)) {
            $hand = self::STRAIGHT;
        } elseif ($this->pair($ranks)) {
            $hand = self::PAIR;
        }
        return $hand;
    }

    private function pair(array $ranks): bool
    {
        // 修正　スマートな方法に修正
        // return ($ranks[0] === $ranks[1]) || ($ranks[1] === $ranks[2]);
        return count(array_unique($ranks)) === 2;
    }

    private function straight(array $ranks): bool
    {
        // Q-K-A 11-12-13も含む
        // 昇順にソート。降順の方がいいのか？
        sort($ranks);
        return range($ranks[0], $ranks[0] + count($ranks) - 1) === $ranks || $this->maxMin($ranks);
    }

    // A-2-3 12-1-2の場合の処理
    public function maxMin(array $ranks): bool
    {
        // 修正
        // return (($maxRanks - $minRanks) === (max(PokerCard::CARD_RANK) - min(PokerCard::CARD_RANK)) && ($ranks[1] - $minRanks) === 1);
        return $ranks === [min(PokerCard::CARD_RANK), min(PokerCard::CARD_RANK) + 1, max(PokerCard::CARD_RANK)];
    }

    public function threeOfAKind(array $ranks): bool
    {
        // return count(array_unique($ranks)) === 1;
        $countRanks = array_count_values($ranks);
        return in_array(3, $countRanks);
        ;
    }
}
$rule = new ThreePokerCardRule();
$rule->threeOfAKind(['13','13','13']);
