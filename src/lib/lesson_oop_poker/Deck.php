<?php

require_once('Card.php');

class Deck
{
    private array $cards;

    public function __construct()
    {
        foreach (['C', 'H', 'S', 'D'] as $suit) {
            foreach (range(1, 13) as $number) {
                // カードを作成 （suit,　数）を引数とするcardインスタンスの配列を作成
                $this->cards[] = new Card($suit, $number);
            }
        }
    }

    public function drawCards(int $drawNum): array
    {
        return array_slice($this->cards, 0, $drawNum);
    }
}
