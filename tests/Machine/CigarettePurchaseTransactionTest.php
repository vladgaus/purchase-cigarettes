<?php

namespace App\Machine;

use PHPUnit\Framework\TestCase;

class CigarettePurchaseTransactionTest extends TestCase
{
    public function testCigarettePurchaseTransactionObject()
    {
        $itemCount = 1;
        $amount = 7.00;
        $purchaseTransaction = new CigarettePurchaseTransaction($itemCount, $amount);
        $this->assertEquals($itemCount, $purchaseTransaction->getItemQuantity());
        $this->assertEquals($amount, $purchaseTransaction->getPaidAmount());
    }
}
