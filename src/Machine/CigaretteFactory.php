<?php

namespace App\Machine;

class CigaretteFactory extends ProductFactory
{
    /**
     * Set properties for cigarette purchase Transaction
     *
     * @param int   $quantity
     * @param float $paidAmount
     *
     * @return PurchaseTransactionInterface
     */
    public function setPurchaseTransaction(int $quantity, float $paidAmount): PurchaseTransactionInterface
    {
        return new CigarettePurchaseTransaction($quantity, $paidAmount);
    }
    
    /**
     * Set cigarette machine Interface
     *
     * @return MachineInterface
     */
    public function setMachine(): MachineInterface
    {
        return new CigaretteMachine();
    }
    
}
