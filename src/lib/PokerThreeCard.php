<?php

namespace PokerGame\ThreeCard;

const HIGH_CARD = 'high card';
const PAIR = 'pair';
const THREE_OF_A_KIND = 'three card';
const STRAIGHT = 'straight';

const CARDS = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
define('CARD_RANK', (function () {
    $cardRanks = [];
    foreach (CARDS as $index => $card) {
        $cardRanks[$card] = $index;
    }
    return $cardRanks;
})());

const HAND_RANK = [
    HIGH_CARD => 1,
    PAIR => 2,
    THREE_OF_A_KIND => 3,
    STRAIGHT => 4,
];

function showDown(string $card11, string $card12, string $card21, string $card22): array
{
    $cardRanks = convertToCardRanks([$card11, $card12, $card21, $card22]);
    $playerCardRanks = array_chunk($cardRanks, 2);
    $hands = array_map(fn ($playerCardRank) => checkHand($playerCardRank[0], $playerCardRank[1]), $playerCardRanks);
    $winner = decideWinner($hands[0], $hands[1]);
    return [$hands[0]['name'], $hands[1]['name'], $winner];
}

function convertToCardRanks(array $cards): array
{
    return array_map(fn ($card) => CARD_RANK[substr($card, 1, strlen($card) - 1)], $cards);
}

function checkHand(int $cardRank1, int $cardRank2): array
{
    $primary = max($cardRank1, $cardRank2);
    $secondary = min($cardRank1, $cardRank2);
    $name = HIGH_CARD;

    if (isStraight($cardRank1, $cardRank2)) {
        $name = STRAIGHT;
        if (isMinMax($cardRank1, $cardRank2)) {
            $primary = min(CARD_RANK);
            $secondary = max(CARD_RANK);
        }
    } elseif (isPair($cardRank1, $cardRank2)) {
        $name = PAIR;
    }

    return [
        'name' => $name,
        'rank' => HAND_RANK[$name],
        'primary' => $primary,
        'secondary' => $secondary,
    ];
}

function isStraight(int $cardRank1, int $cardRank2): bool
{
    return abs($cardRank1 - $cardRank2) === 1 || isMinMax($cardRank1, $cardRank2);
}

function isMinMax(int $cardRank1, int $cardRank2): bool
{
    return abs($cardRank1 - $cardRank2) === (max(CARD_RANK) - min(CARD_RANK));
}

function isPair(int $cardRank1, int $cardRank2): bool
{
    return $cardRank1 === $cardRank2;
}

function decideWinner(array $hand1, array $hand2): int
{
    foreach (['rank', 'primary', 'secondary'] as $k) {
        if ($hand1[$k] > $hand2[$k]) {
            return 1;
        }

        if ($hand1[$k] < $hand2[$k]) {
            return 2;
        }
    }

    return 0;
}
