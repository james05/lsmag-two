<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Loyalty\Entity;

use IteratorAggregate;
use ArrayIterator;

class ArrayOfTransactionFooter implements IteratorAggregate
{

    /**
     * @property TransactionFooter[] $TransactionFooter
     */
    protected $TransactionFooter = array(
        
    );

    /**
     * @param TransactionFooter[] $TransactionFooter
     * @return $this
     */
    public function setTransactionFooter($TransactionFooter)
    {
        $this->TransactionFooter = $TransactionFooter;
        return $this;
    }

    /**
     * @return TransactionFooter[]
     */
    public function getIterator()
    {
        return new ArrayIterator( $this->TransactionFooter );
    }

    /**
     * @return TransactionFooter[]
     */
    public function getTransactionFooter()
    {
        return $this->TransactionFooter;
    }


}
