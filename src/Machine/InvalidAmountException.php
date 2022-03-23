<?php

namespace App\Machine;

use Throwable;

class InvalidAmountException extends \Exception
{
    /**
     * Return missed coins for by more packs
     *
     * @var float
     */
    private $missedCoins;
    
    /**
     * Set properties for InvalidAmountException
     *
     * @param float $missedCoins
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(float $missedCoins = 0, int $code = 0, Throwable $previous = null)
    {
        $this->missedCoins = $missedCoins;
        parent::__construct($missedCoins, $code, $previous);
    }
    
    /**
     * Get answer
     *
     * @return float
     */
    public function getCoins(): float
    {
        return $this->missedCoins;
    }
}