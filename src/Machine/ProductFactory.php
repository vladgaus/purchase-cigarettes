<?php

namespace App\Machine;

abstract class ProductFactory
{
    /**
     * Set purchase transaction Interface
     *
     * @param int   $quantity
     * @param float $paidAmount
     * @return PurchaseTransactionInterface
     */
    abstract public function setPurchaseTransaction(int $quantity, float $paidAmount): PurchaseTransactionInterface;

    /**
     * Set machine Interface
     *
     * @return MachineInterface
     */
    abstract public function setMachine(): MachineInterface;
}