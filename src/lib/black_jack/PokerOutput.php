<?php

namespace BlackJack;

class PokerOutput
{
    private const PLAYER_NAME_INDENT = 0;
    public function displayPlayerCard(array $playerHands, array $playerNames): void
    {
        echo "あなたの引いたカードは{$playerHands[$playerNames[self::PLAYER_NAME_INDENT]][0]}です。" . PHP_EOL;
        echo "あなたの引いたカードは{$playerHands[$playerNames[self::PLAYER_NAME_INDENT]][1]}です。" . PHP_EOL;
    }
}
