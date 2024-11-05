<?php

class Player
{
    public function __construct(private string $name)
    {
    }

    public function drawCards()
    {
        return ['H10','H10'];
    }
}
