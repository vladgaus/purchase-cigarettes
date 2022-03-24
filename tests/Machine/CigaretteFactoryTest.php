<?php

namespace App\Machine;

use PHPUnit\Framework\TestCase;

class CigaretteFactoryTest extends TestCase
{
    public function testSetMachineInterface()
    {
        $cigaretteFactory =  new CigaretteFactory();
        $cigaretteMachine = $cigaretteFactory->setMachine();
        $this->assertInstanceOf(MachineInterface::class, $cigaretteMachine);
    }
    
    public function testSetPurchaseTransactionInterface()
    {
        $cigaretteFactory =  new CigaretteFactory();
        $cigaretteMachine = $cigaretteFactory->setPurchaseTransaction(1, 10.00);
        $this->assertInstanceOf(PurchaseTransactionInterface::class, $cigaretteMachine);
    }
}
