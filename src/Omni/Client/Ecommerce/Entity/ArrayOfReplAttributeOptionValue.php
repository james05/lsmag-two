<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 * @codingStandardsIgnoreFile
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

use IteratorAggregate;
use ArrayIterator;

class ArrayOfReplAttributeOptionValue implements IteratorAggregate
{

    /**
     * @property ReplAttributeOptionValue[] $ReplAttributeOptionValue
     */
    protected $ReplAttributeOptionValue = [
        
    ];

    /**
     * @param ReplAttributeOptionValue[] $ReplAttributeOptionValue
     * @return $this
     */
    public function setReplAttributeOptionValue($ReplAttributeOptionValue)
    {
        $this->ReplAttributeOptionValue = $ReplAttributeOptionValue;
        return $this;
    }

    /**
     * @return ReplAttributeOptionValue[]
     */
    public function getIterator()
    {
        return new ArrayIterator( $this->ReplAttributeOptionValue );
    }

    /**
     * @return ReplAttributeOptionValue[]
     */
    public function getReplAttributeOptionValue()
    {
        return $this->ReplAttributeOptionValue;
    }


}

