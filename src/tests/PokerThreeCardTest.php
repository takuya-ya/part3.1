<?php

namespace PokerGame\ThreeCard;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../lib/PokerThreeCard.php';

class PokerThreeCardTest extends TestCase
{
    public function testShowDown(): void
    {
        $this->assertSame(['high card', 'high card', 1], showDown('CK', 'DJ', 'C10', 'H10', 'S9', 'D7'));
        $this->assertSame(['high card', 'straight', 2], showDown('CK', 'DJ', 'C3', 'H4', 'S5', 'D6'));
        $this->assertSame(['high card', 'high card', 2], showDown('C3', 'H4', 'DK', 'SK', 'D5', 'H6'));
        $this->assertSame(['straight', 'straight', 1], showDown('HJ', 'SK', 'DQ', 'D10', 'C9', 'H8'));
        $this->assertSame(['one pair', 'high card', 1], showDown('H9', 'SK', 'DK', 'D10', 'S7', 'D6'));
        $this->assertSame(['one pair', 'high card', 1], showDown('H3', 'S5', 'D5', 'D3', 'C4', 'S6'));
        $this->assertSame(['one pair', 'straight', 2], showDown('CA', 'DA', 'C2', 'D2', 'S3', 'H4'));
        $this->assertSame(['one pair', 'high card', 1], showDown('CK', 'DK', 'CA', 'DA', 'S4', 'C5'));
        $this->assertSame(['three of a kind', 'high card', 1], showDown('C4', 'D4', 'H4', 'S2', 'C3', 'D5'));
        $this->assertSame(['straight', 'high card', 1], showDown('SA', 'DK', 'C2', 'CA', 'H3', 'D4'));
        $this->assertSame(['one pair', 'straight', 2], showDown('C2', 'CA', 'S2', 'D3', 'H4', 'C5'));
        $this->assertSame(['one pair', 'straight', 2], showDown('S2', 'D3', 'C2', 'H3', 'S4', 'D5'));
    }
}
