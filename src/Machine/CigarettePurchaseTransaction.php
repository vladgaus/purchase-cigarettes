<?php

namespace App\Machine;

class CigarettePurchaseTransaction implements PurchaseTransactionInterface
{
    /**
     * Quantity
     *
     * @var int
     */
    private $quantity;
    
    /**
     * Paid amount
     *
     * @var float
     */
    private $paidAmount;
    
    /**
     * Set properties for CigarettePurchaseTransaction
     *
     * @param int   $quantity
     * @param float $paidAmount
     */
    public function __construct(int $quantity, float $paidAmount)
    {
        $this->quantity = $quantity;
        $this->paidAmount = $paidAmount;
    }
    
    /**
     * Get quantity
     *
     * @return int
     */
    public function getItemQuantity(): int
    {
        return $this->quantity;
    }
    
    /**
     * Get paid amount
     *
     * @return float
     */
    public function getPaidAmount(): float
    {
        return $this->paidAmount;
    }
}
