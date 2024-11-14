<?php

namespace LessonOopPoker;

interface Rule
{
    public function getHand(array $cards);
}
