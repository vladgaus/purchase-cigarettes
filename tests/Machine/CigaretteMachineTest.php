<?php

namespace App\Machine;

use PHPUnit\Framework\TestCase;

class CigaretteMachineTest extends TestCase
{
    public function testExecuteWithCorrectPurchaseTransaction()
    {
        $cigarettePurchaseTransaction = new CigarettePurchaseTransaction(2, 10.00);
        $cigaretteMachine = new CigaretteMachine();
        $cigarettePurchasedItem = $cigaretteMachine->execute($cigarettePurchaseTransaction);
        $this->assertInstanceOf(PurchasedItemInterface::class, $cigarettePurchasedItem);
    }
    
    /**
     * @expectedException App\Machine\InvalidAmountException
     */
    public function testExecutePurchaseTransactionThrowsInvalidAmountException()
    {
        $this->expectException(InvalidAmountException::class);
        $cigarettePurchaseTransaction = new CigarettePurchaseTransaction(2, 8.00);
        $cigaretteMachine = new CigaretteMachine();
        $cigaretteMachine->execute($cigarettePurchaseTransaction);
    }
}
