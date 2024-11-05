<?php

class HandEvaluator
{
    // エラー：　引数にはRuleAかBのインスタンスが入る。間違えてstring型指定した
    public function __construct(private $rule)
    {}

    public function getHand(array $card): string
    {
        return $this->rule->getHand($card);
    }
}
