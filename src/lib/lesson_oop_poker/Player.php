<?php

namespace LessonOopPoker;

require_once('Deck.php');

class Player
{
    public function drawCards(Deck $deck, int $drawNum)
    {
        return $deck->drawCards($drawNum);
    }
}
