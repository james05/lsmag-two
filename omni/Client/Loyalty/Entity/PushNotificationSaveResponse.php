<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Loyalty\Entity;

use Ls\Omni\Client\ResponseInterface;

class PushNotificationSaveResponse implements ResponseInterface
{

    /**
     * @property boolean $PushNotificationSaveResult
     */
    protected $PushNotificationSaveResult = null;

    /**
     * @param boolean $PushNotificationSaveResult
     * @return $this
     */
    public function setPushNotificationSaveResult($PushNotificationSaveResult)
    {
        $this->PushNotificationSaveResult = $PushNotificationSaveResult;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getPushNotificationSaveResult()
    {
        return $this->PushNotificationSaveResult;
    }

    /**
     * @return boolean
     */
    public function getResult()
    {
        return $this->PushNotificationSaveResult;
    }


}
