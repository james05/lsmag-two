<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Loyalty\Entity;

use Ls\Omni\Client\ResponseInterface;

class StoresGetbyItemInStockResponse implements ResponseInterface
{

    /**
     * @property ArrayOfStore $StoresGetbyItemInStockResult
     */
    protected $StoresGetbyItemInStockResult = null;

    /**
     * @param ArrayOfStore $StoresGetbyItemInStockResult
     * @return $this
     */
    public function setStoresGetbyItemInStockResult($StoresGetbyItemInStockResult)
    {
        $this->StoresGetbyItemInStockResult = $StoresGetbyItemInStockResult;
        return $this;
    }

    /**
     * @return ArrayOfStore
     */
    public function getStoresGetbyItemInStockResult()
    {
        return $this->StoresGetbyItemInStockResult;
    }

    /**
     * @return ArrayOfStore
     */
    public function getResult()
    {
        return $this->StoresGetbyItemInStockResult;
    }


}
