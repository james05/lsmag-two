<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 * @codingStandardsIgnoreFile
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

use IteratorAggregate;
use ArrayIterator;

class ArrayOfMenu implements IteratorAggregate
{

    /**
     * @property Menu[] $Menu
     */
    protected $Menu = array(
        
    );

    /**
     * @param Menu[] $Menu
     * @return $this
     */
    public function setMenu($Menu)
    {
        $this->Menu = $Menu;
        return $this;
    }

    /**
     * @return Menu[]
     */
    public function getIterator()
    {
        return new ArrayIterator( $this->Menu );
    }

    /**
     * @return Menu[]
     */
    public function getMenu()
    {
        return $this->Menu;
    }


}
