<?php

namespace PokerGame\ThreeCard;

const HIGH_CARD = 'high card';
const ONE_PAIR = 'one pair';
const THREE_OF_A_KIND = 'three of a kind';
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
    ONE_PAIR => 2,
    THREE_OF_A_KIND => 3,
    STRAIGHT => 4,
];

function showDown(string $card11, string $card12, string $card13, string $card21, string $card22, string $card23): array
{
    $cardRanks = convertToCardRanks([$card11, $card12, $card13, $card21, $card22, $card23]);
    $playerCardRanks = array_chunk($cardRanks, 3);
    $hands = array_map(fn ($playerCardRank)
    => checkHand($playerCardRank[0], $playerCardRank[1], $playerCardRank[2]), $playerCardRanks);
    $winner = decideWinner($hands[0], $hands[1]);
    return [$hands[0]['name'], $hands[1]['name'], $winner];
}

function convertToCardRanks(array $cards): array
{
    return array_map(fn ($card) => CARD_RANK[substr($card, 1, strlen($card) - 1)], $cards);
}

function checkHand(int $cardRank1, int $cardRank2, int $cardRank3): array
{
    $sortRank = [$cardRank1, $cardRank2, $cardRank3];
    $primary = max($cardRank1, $cardRank2, $cardRank3);
    $secondary = $sortRank[1];
    $tertiary = min($cardRank1, $cardRank2, $cardRank3);
    $name = HIGH_CARD;

    rsort($sortRank);

    if (isStraight($sortRank)) {
        $name = STRAIGHT;
        if (isMinMax($sortRank)) {
            $primary = min(CARD_RANK);
            $secondary = $sortRank[1];
            $tertiary = max(CARD_RANK);
        }
    } elseif (onePair($sortRank)) {
        $name = ONE_PAIR;
    } elseif (threeCard($sortRank)) {
        $name = THREE_OF_A_KIND;
    }

    return [
        'name' => $name,
        'rank' => HAND_RANK[$name],
        'primary' => $primary,
        'secondary' => $secondary,
        'tertiary' => $tertiary
    ];
}

function isStraight(array $sortRank): bool
{
    return ($sortRank[0] - $sortRank[1]) === 1 && ($sortRank[1] - $sortRank[2]) === 1 || isMinMax($sortRank);
}

function isMinMax(array $sortRank): bool
{
    return ($sortRank[0] - $sortRank[2]) === (max(CARD_RANK) - min(CARD_RANK))
    && ($sortRank[1] === 11 || $sortRank[1] === 1);
}

function onePair(array $sortRank): bool
{
    return in_array(2, (array_count_values($sortRank)));
}

function threeCard(array $sortRank): bool
{
    return $sortRank[0] === $sortRank[1] && $sortRank[1] === $sortRank[2];
}
function decideWinner(array $hand1, array $hand2): int
{
    foreach (['rank', 'primary', 'secondary', 'tertiary'] as $k) {
        if ($hand1[$k] > $hand2[$k]) {
            return 1;
        }

        if ($hand1[$k] < $hand2[$k]) {
            return 2;
        }
    }

    return 0;
}
