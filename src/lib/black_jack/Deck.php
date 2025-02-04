<?php

namespace BlackJack;

use BlackJack\Card;

class Deck
{
    // ゲームで使用する山札
    public array $cardDeck = [];
    public array $drawnCard = [];

    public function __construct(public Card $card)
    {
        shuffle($this->card->cards);
        $this->cardDeck = $this->card->cards;
    }

    public function drawCard(int $drawCardNum): array
    {
        // 山札からカードを取得し、取得したカードは山札から削除
        $this->drawnCard = array_splice($this->cardDeck, 0, $drawCardNum);
        return $this->drawnCard;
    }

    // // TODO 不要では？ここでスタート手札を作成するのでなく、playerのgetHand()で初回手札作成。その為にdealerとdeckにカードを引かせる　そうすると、この関数が不要だし、もともとこの関数までプレイヤー名を渡し渡ししてここで初回カードを組んで返して返してとしていた　渡すのと返すのが無駄。また、deckはカードを引く処理のみに単一責任になる
    // public function startHands(): array
    // {
    //         $this->drawCard(2);
    //         return $this->drawnCard;
    // }
}
