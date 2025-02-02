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

    public function displayDealerCard(array $dealerHand): void
    {
        echo "ディーラーの引いたカードは{$dealerHand[0]}です。" . PHP_EOL;
        echo 'ディーラーの引いた2枚目のカードはわかりません。' . PHP_EOL;
        echo PHP_EOL;
    }

    public function displayDealerTurn(string $drawnLastCard): void
    {
        echo "ディーラーの引いたカードは{$drawnLastCard}です。" . PHP_EOL;
    }

    public function displayAddDealerCard(array $hands)
    {
        echo "ディーラーの引いた2枚目のカードは{$hands['dealerHand'][1]}でした。" . PHP_EOL;
        // echo "ディーラーの現在の得点は{$dealerScore}です。" . PHP_EOL;
        // echo PHP_EOL;
    }

    public function displayDealerScore(int $dealerScore)
    {
        echo "ディーラーの現在の得点は{$dealerScore}です。" . PHP_EOL;
        echo PHP_EOL;
    }
}
