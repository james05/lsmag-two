<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 * @codingStandardsIgnoreFile
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

class ItemUnitOfMeasure extends Entity
{

    /**
     * @property boolean $CountAsOne
     */
    protected $CountAsOne = null;

    /**
     * @property string $ItemId
     */
    protected $ItemId = null;

    /**
     * @property float $QtyPerUnitOfMeasure
     */
    protected $QtyPerUnitOfMeasure = null;

    /**
     * @property boolean $Selection
     */
    protected $Selection = null;

    /**
     * @property int $UomOrder
     */
    protected $UomOrder = null;

    /**
     * @param boolean $CountAsOne
     * @return $this
     */
    public function setCountAsOne($CountAsOne)
    {
        $this->CountAsOne = $CountAsOne;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getCountAsOne()
    {
        return $this->CountAsOne;
    }

    /**
     * @param string $ItemId
     * @return $this
     */
    public function setItemId($ItemId)
    {
        $this->ItemId = $ItemId;
        return $this;
    }

    /**
     * @return string
     */
    public function getItemId()
    {
        return $this->ItemId;
    }

    /**
     * @param float $QtyPerUnitOfMeasure
     * @return $this
     */
    public function setQtyPerUnitOfMeasure($QtyPerUnitOfMeasure)
    {
        $this->QtyPerUnitOfMeasure = $QtyPerUnitOfMeasure;
        return $this;
    }

    /**
     * @return float
     */
    public function getQtyPerUnitOfMeasure()
    {
        return $this->QtyPerUnitOfMeasure;
    }

    /**
     * @param boolean $Selection
     * @return $this
     */
    public function setSelection($Selection)
    {
        $this->Selection = $Selection;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getSelection()
    {
        return $this->Selection;
    }

    /**
     * @param int $UomOrder
     * @return $this
     */
    public function setUomOrder($UomOrder)
    {
        $this->UomOrder = $UomOrder;
        return $this;
    }

    /**
     * @return int
     */
    public function getUomOrder()
    {
        return $this->UomOrder;
    }


}

