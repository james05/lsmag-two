<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 * @codingStandardsIgnoreFile
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

use Ls\Omni\Client\ResponseInterface;

class OrderCancelResponse implements ResponseInterface
{

    /**
     * @property string $OrderCancelResult
     */
    protected $OrderCancelResult = null;

    /**
     * @param string $OrderCancelResult
     * @return $this
     */
    public function setOrderCancelResult($OrderCancelResult)
    {
        $this->OrderCancelResult = $OrderCancelResult;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderCancelResult()
    {
        return $this->OrderCancelResult;
    }

    /**
     * @return string
     */
    public function getResult()
    {
        return $this->OrderCancelResult;
    }


}
