<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/oop_poker/ConvertToNumber.php');

class ConvertToNumberTest extends TestCase
{
    public function testConvertToNum()
        {
            $card1 = new ConvertToNumber(['CA', 'DA']);
            $this->assertSame([13, 13], $card1->convertToNum());
            $card2 = new ConvertToNumber(['C10', 'H10']);
            $this->assertSame([9, 9], $card2->convertToNum());
        }
}
