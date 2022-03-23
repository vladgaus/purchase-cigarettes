<?php

namespace App\Machine;

class CigarettePurchasedItem implements PurchasedItemInterface
{
    /**
     * Price for one pack of cigarette
     *
     * @var float
     */
    private $price = 4.99;
    
    /**
     * List of coins
     *
     * @var array
     */
    private $coins;
    
    /**
     * @var PurchaseTransactionInterface
     */
    private $purchaseTransaction;
    
    /**
     * Set properties for CigarettePurchasedItem
     * @param PurchaseTransactionInterface $purchaseTransaction
     */
    public function __construct(PurchaseTransactionInterface $purchaseTransaction)
    {
        // set transaction
        $this->purchaseTransaction = $purchaseTransaction;
        
        // set coins
        rsort(Coins::$euro);
        $this->coins = Coins::$euro;
    }
    
    /**
     * @return integer
     */
    public function getItemQuantity(): int
    {
        return $this->purchaseTransaction->getItemQuantity();
    }
    
    /**
     * @return float
     */
    public function getTotalAmount(): float
    {
        return $this->purchaseTransaction->getItemQuantity() * $this->price;
    }
    
    /**
     * Calculate change
     *
     * @return array
     */
    private function calculate($totalMissing)
    {
        $listCoins = [];
        foreach ($this->coins as $coin) {
            $count = self::calculateCash(ceil($totalMissing * 100), $coin * 100);
            if ($count > 0) {
                $listCoins[] = [sprintf('%.2f', $coin), $count];
                $totalMissing -= $coin * $count;
            }
        }
        return $listCoins;
    }
    
    /**
     * Calculate cash
     *
     * @param int $totalMissing
     * @param int $coin
     * @return int
     */
    private static function calculateCash(int $totalMissing, int $coin): int
    {
        return ($totalMissing < $coin) ? 0 : self::calculateCash($totalMissing - $coin, $coin) + 1;
    }
    
    /**
     * returns the amount missing for the payment
     *
     * @return float
     */
    public function getMissingCoins(): float
    {
        $amountMissing = $this->getTotalAmount() - $this->purchaseTransaction->getPaidAmount();
        return ($amountMissing > 0) ? $amountMissing : 0;
    }
    
    /**
     * Check need more coins?
     *
     * @return bool
     */
    public function isNeedMoreCoins(): bool
    {
        return $this->getMissingCoins() > 0;
    }
    
    /**
     * return true if some amount is missing
     *
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }
    
    /**
     * Get calculated change
     *
     * @return array
     */
    public function getChange(): array
    {
        return $this->calculate($this->purchaseTransaction->getPaidAmount() - $this->getTotalAmount());
    }
}
