<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/oop_poker/ConvertToNumber.php');

class ConvertToNumberTest extends TestCase
{
    function testConvertToNumber()
    {
        $card1 = new ConvertToNumber(['CA', 'DA']);
        $this->assertSame([13, 13], $card1->convertToNum());
    }
}
