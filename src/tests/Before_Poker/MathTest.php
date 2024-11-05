<?php

declare(strict_types=1);

namespace Math;

use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{
    public function testDouble(): void
    {
        require_once(__DIR__ . '/../../lib/Before_Poker/Math.php');
        $this->assertSame(4, double(2));
    }
}
