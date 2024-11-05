<?php

require_once 'Rule.php';

class RuleB implements Rule
{
    public function getHand(array $cards)
    {
        return 'pair';
    }
}
