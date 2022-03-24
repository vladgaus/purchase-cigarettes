<?php

namespace App\Machine;

use PHPUnit\Framework\TestCase;

class CigarettePurchasedItemTest extends TestCase
{
    /**
     * @dataProvider providerMachine
     */
    public function testCigarettePurchasedItem(
        int $quantity,
        float $paidAmount,
        float $totalAmount,
        array $change,
        float $missingCoins,
        bool $isNeedMoreCoins
    )
    {
        $purchaseTransaction = new CigarettePurchaseTransaction($quantity, $paidAmount);
        $purchasedItem = new CigarettePurchasedItem($purchaseTransaction);
        $this->assertEquals($quantity, $purchasedItem->getItemQuantity());
        $this->assertEquals($totalAmount, $purchasedItem->getTotalAmount());
        $this->assertEquals($change, $purchasedItem->getChange());
        $this->assertEquals($missingCoins, $purchasedItem->getMissingCoins());
        $this->assertEquals($isNeedMoreCoins, $purchasedItem->isNeedMoreCoins());
    }
    
    public function providerMachine()
    {
        return [
            // When amount of coins enougth and no need more coins and not empty change
            [
                1,
                10.00,
                4.99,
                [
                    ['5.00', 1],
                    ['0.01', 1],
                ],
                0,
                false
            ],
            // When amount of coins not enougth and need more coins
            [
                3,
                10.00,
                14.97,
                [],
                4.97,
                true
            ],
            // When amount of coins enougth and no need more coins and empty change
            [
                2,
                9.98,
                9.98,
                [],
                0,
                false
            ],
        ];
    }
}
