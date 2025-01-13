<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\PointCalculator;

require_once(__DIR__ . '/../../lib/black_jack/PointCalculator.php');

class PointCalculatorTest extends TestCase {

  public function testPointCalculator() {
      $pointCalculator = new PointCalculator;
      $point = $pointCalculator->calculatePoint(['H3', 'H1']);
      $this->assertSame(4, $point);
      $point = $pointCalculator->calculatePoint(['HQ', 'DK', 'K1']);
      $this->assertSame(21, $point);
  }
}
