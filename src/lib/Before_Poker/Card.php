<?php

function convertToNumber(string ...$cards): array
{
    return array_map(fn($card) => substr($card, 1), $cards);
}
