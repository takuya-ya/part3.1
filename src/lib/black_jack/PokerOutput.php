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

    public function displayAddDealerCard(array $hands): void
    {
        echo "ディーラーの引いた2枚目のカードは{$hands['dealerHand'][1]}でした。" . PHP_EOL;
    }

    public function displayDealerScore(int $dealerScore): void
    {
        echo "ディーラーの現在の得点は{$dealerScore}です。" . PHP_EOL;
        echo PHP_EOL;
    }

    public function displayPlayerWinMessage(): string
    {
        return "あなたの勝ちです。";
    }

    public function displayPlayerLoseMessage(): string
    {
        return "あなたの負けです。";
    }

    public function displayPlayerScore(int $playerScore): void
    {
        echo "あなたの現在の得点は{$playerScore}です。カードを引きますか？（Y/N）" . PHP_EOL;
    }

    public function displayAddPlayerCard(string $drawnLastCard): void
    {
        echo "あなたの引いたカードは{$drawnLastCard}です。" . PHP_EOL;
    }

    public function displayGameResult(int $playerScore, int $dealerScore, string $winner): string
    {
        echo "あなたの得点は{$playerScore}です。" . PHP_EOL;
        echo "ディーラーの得点は{$dealerScore}です。" . PHP_EOL;
        echo PHP_EOL;
        echo "{$winner}の勝ちです！" . PHP_EOL;
        return $winner;
    }
}
