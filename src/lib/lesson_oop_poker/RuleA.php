<?php

namespace LessonOopPoker;

require_once 'Rule.php';

class RuleA implements Rule
{
    public function getHand(array $cards): string
    {
        return 'pair';
    }
}
