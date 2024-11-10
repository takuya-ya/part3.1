<?php

namespace OopPoker;

class PokerCard
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

    // [H10,H11]
    // 上記は間違い。cardクラスは一枚のカードを扱うクラス。また、今回はカード一枚
    // PokerGameの冒頭で受けたカードを入れている H10
    public function __construct(private string $card)
    {}

    public function getRank(): int
    {
        // カードから数字を抽出し、定数のキーに当てて、ランクに変換
        //return （ランク）[9, 10]
        return self::CARD_RANK[substr($this->card, 1, strlen($this->card) - 1)];

        // 削除　Gameクラスでsuitの削除をしてしまっており、単一責任から外れているため
        //$cardRanks[] = array_map(fn($playerCardNum) => self::CARD_RANK[$playerCardNum], $card);
    }
}

// $game = new PokerCard(['A', 'A'], ['10', '10']);
// $game->getRank();
