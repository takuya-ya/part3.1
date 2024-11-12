<?php

namespace OopPoker;

interface PokerHandEvaluator
{
    public function getHand(array $pokerCard): array;
}
