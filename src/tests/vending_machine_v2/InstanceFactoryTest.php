<?php

namespace VendingMachineV2Test;

use PHPUnit\Framework\TestCase;
use VendingMachineV2\InstanceFactory;
use VendingMachineV2\Cola;

class InstanceFactoryTest extends TestCase
{
    public function testInstanceFactory()
    {
        $instanceFactory = new InstanceFactory;
        $this->assertEquals(new Cola, $instanceFactory->selectItem('cola'));
    }
}
