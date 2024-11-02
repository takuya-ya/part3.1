<?php

namespace PaymentAmountSuper;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../lib/PaymentAmountSuper.php';

class PaymentAmountSuperTest extends TestCase
{
    public function testCalc(): void
    {
        $this->assertSame(1298, calc('21:00', [1, 1, 1, 3, 5, 7, 8, 9, 10]));
    }
}
