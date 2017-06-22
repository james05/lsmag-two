<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

use Ls\Omni\Client\RequestInterface;

class RecommendedItemsGetByUserId implements RequestInterface
{

    /**
     * @property string $userId
     */
    protected $userId = null;

    /**
     * @property ArrayOfItem $items
     */
    protected $items = null;

    /**
     * @property int $maxNumberOfItems
     */
    protected $maxNumberOfItems = null;

    /**
     * @param string $userId
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param ArrayOfItem $items
     * @return $this
     */
    public function setItems($items)
    {
        $this->items = $items;
        return $this;
    }

    /**
     * @return ArrayOfItem
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param int $maxNumberOfItems
     * @return $this
     */
    public function setMaxNumberOfItems($maxNumberOfItems)
    {
        $this->maxNumberOfItems = $maxNumberOfItems;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxNumberOfItems()
    {
        return $this->maxNumberOfItems;
    }


}
