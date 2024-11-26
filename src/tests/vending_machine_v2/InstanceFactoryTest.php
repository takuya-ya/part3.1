<?php

namespace VendingMachineV2Test;

use PHPUnit\Framework\TestCase;
use VendingMachineV2\InstanceFactory;
use VendingMachineV2\Cola;
use VendingMachineV2\Cider;

class InstanceFactoryTest extends TestCase
{
    public function testInstanceFactory()
    {
        $instanceFactory = new InstanceFactory;
        $this->assertEquals(new Cola, $instanceFactory->selectItem('cola'));
        $this->assertEquals(new Cider, $instanceFactory->selectItem('cider'));
    }
}
