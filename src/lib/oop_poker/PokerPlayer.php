<?php


class PokerPlayer
{
    const CARD_RANK = [
        '2' => 1,
        '3' => 2,
        '4' => 3,
        '5' => 4,
        '6' => 5,
        '7' => 6,
        '8' => 7,
        '9' => 8,
        '10' => 9,
        'J' => 10,
        'Q' => 11,
        'K' => 12,
        'A' => 13,
    ];

    public function __construct(private array $cards)
    {
    }

    public function convertToNum(): array
    {
        //カードの数字部分を、数字＝＞ランクの配列に変換。数字を入れてランクを呼び出せる
        $nums = array_map((fn($card) => substr($card, 1)), $this->cards);

        foreach ($nums as $num) {
            $handRanks[] = $this::CARD_RANK[$num];
        }
        return $handRanks;
    }
}

// $card1 = new ConvertToNumber(['CA', 'DA']);
// $card1->convertToNum();
