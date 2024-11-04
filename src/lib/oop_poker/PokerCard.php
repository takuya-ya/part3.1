<?php

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

    // [[10,10],[11,11]]
    public function __construct(private array $cardNumbers)
    {}

    public function getRank(): array
    {
        $cardRanks = [];
        foreach ($this->cardNumbers as $playerCardNums)
        {
          $cardRanks[] = array_map(fn($playerCardNum) => self::CARD_RANK[$playerCardNum], $playerCardNums);

        }

        return $cardRanks;
    }
}

// $game = new PokerCard(['A', 'A'], ['10', '10']);
// $game->getRank();
