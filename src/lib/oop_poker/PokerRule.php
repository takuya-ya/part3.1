<?php

namespace OopPoker;

interface PokerRule
{
    public function getHand(array $pokerCards);
}
