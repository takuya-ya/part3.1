<?php

namespace BlackJack;

class Deck
{
    public function drawCard()
    {
        $card = new Card;
        return $card->cards[0];
    }
}
