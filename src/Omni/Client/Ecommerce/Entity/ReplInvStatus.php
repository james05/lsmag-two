<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 * @codingStandardsIgnoreFile
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

class ReplInvStatus
{

    /**
     * @property boolean $IsDeleted
     */
    protected $IsDeleted = null;

    /**
     * @property string $ItemId
     */
    protected $ItemId = null;

    /**
     * @property float $Quantity
     */
    protected $Quantity = null;

    /**
     * @property string $StoreId
     */
    protected $StoreId = null;

    /**
     * @property string $VariantId
     */
    protected $VariantId = null;

    /**
     * @param boolean $IsDeleted
     * @return $this
     */
    public function setIsDeleted($IsDeleted)
    {
        $this->IsDeleted = $IsDeleted;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsDeleted()
    {
        return $this->IsDeleted;
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
     * @param float $Quantity
     * @return $this
     */
    public function setQuantity($Quantity)
    {
        $this->Quantity = $Quantity;
        return $this;
    }

    /**
     * @return float
     */
    public function getQuantity()
    {
        return $this->Quantity;
    }

    /**
     * @param string $StoreId
     * @return $this
     */
    public function setStoreId($StoreId)
    {
        $this->StoreId = $StoreId;
        return $this;
    }

    /**
     * @return string
     */
    public function getStoreId()
    {
        return $this->StoreId;
    }

    /**
     * @param string $VariantId
     * @return $this
     */
    public function setVariantId($VariantId)
    {
        $this->VariantId = $VariantId;
        return $this;
    }

    /**
     * @return string
     */
    public function getVariantId()
    {
        return $this->VariantId;
    }


}

