<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 * @codingStandardsIgnoreFile
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

use Ls\Omni\Client\ResponseInterface;

class ActivityAvailabilityGetResponse implements ResponseInterface
{

    /**
     * @property ArrayOfAvailabilityResponse $ActivityAvailabilityGetResult
     */
    protected $ActivityAvailabilityGetResult = null;

    /**
     * @param ArrayOfAvailabilityResponse $ActivityAvailabilityGetResult
     * @return $this
     */
    public function setActivityAvailabilityGetResult($ActivityAvailabilityGetResult)
    {
        $this->ActivityAvailabilityGetResult = $ActivityAvailabilityGetResult;
        return $this;
    }

    /**
     * @return ArrayOfAvailabilityResponse
     */
    public function getActivityAvailabilityGetResult()
    {
        return $this->ActivityAvailabilityGetResult;
    }

    /**
     * @return ArrayOfAvailabilityResponse
     */
    public function getResult()
    {
        return $this->ActivityAvailabilityGetResult;
    }


}
