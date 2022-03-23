<?php

namespace App\Machine;

/**
 * Class CigaretteMachine
 * @package App\Machine
 */
class CigaretteMachine implements MachineInterface
{
    /**
     * @param PurchaseTransactionInterface $purchaseTransaction
     *
     * @return CigarettePurchasedItem
     * @throws InvalidAmountException
     */
    public function execute(PurchaseTransactionInterface $purchaseTransaction)
    {
        $cigarettePurchasedItem = new CigarettePurchasedItem($purchaseTransaction);
        if ($cigarettePurchasedItem->isNeedMoreCoins()) {
            throw new InvalidAmountException($cigarettePurchasedItem->getMissingCoins());
        }
        return $cigarettePurchasedItem;
    }
}
