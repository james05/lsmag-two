<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

use Ls\Omni\Client\ResponseInterface;

class ContactGetByIdResponse implements ResponseInterface
{

    /**
     * @property Contact $ContactGetByIdResult
     */
    protected $ContactGetByIdResult = null;

    /**
     * @param Contact $ContactGetByIdResult
     * @return $this
     */
    public function setContactGetByIdResult($ContactGetByIdResult)
    {
        $this->ContactGetByIdResult = $ContactGetByIdResult;
        return $this;
    }

    /**
     * @return Contact
     */
    public function getContactGetByIdResult()
    {
        return $this->ContactGetByIdResult;
    }

    /**
     * @return Contact
     */
    public function getResult()
    {
        return $this->ContactGetByIdResult;
    }


}
