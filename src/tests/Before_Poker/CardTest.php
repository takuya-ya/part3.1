<?php

namespace lib;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../lib/Before_Poker/Card.php';

class CardTest extends TestCase
{
    public function testConvertToNumber()
    {
        $this -> assertSame(['7'], convertToNumber('C7'));
        $this -> assertSame(['3', '10', 'A'], convertToNumber('H3', 'S10', 'DA'));
    }
}
