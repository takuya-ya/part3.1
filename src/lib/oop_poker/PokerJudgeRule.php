<?php

namespace OopPoker;

interface PokerJudgeRule
{
    public function getWinner(array $hands): int;
}
