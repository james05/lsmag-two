<?php

namespace Ls\Omni\Helper;

use Exception;
use \Ls\Core\Model\LSR;
use \Ls\Omni\Client\Ecommerce\Entity\StoreHours;
use \Ls\Omni\Client\Ecommerce\Operation\StoreGetById;
use \Ls\Omni\Model\Cache\Type;
use \Ls\Replication\Api\ReplStoreRepositoryInterface;
use Magento\Checkout\Model\Session\Proxy;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Session\SessionManagerInterface;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class Data
 * @package Ls\Omni\Helper
 */
class Data extends AbstractHelper
{
    /** @var StoreManagerInterface */
    public $storeManager;

    /** @var ReplStoreRepositoryInterface */
    public $storeRepository;

    /** @var SearchCriteriaBuilder $searchCriteriaBuilder */
    public $searchCriteriaBuilder;

    /**
     * @var SessionManagerInterface
     */
    public $session;

    /**
     * @var Proxy
     */
    public $checkoutSession;

    /** @var ManagerInterface */
    public $messageManager;

    /**
     * @var \Magento\Framework\Pricing\Helper\Data
     */
    public $priceHelper;

    /**
     * @var LoyaltyHelper
     */
    public $loyaltyHelper;

    /**
     * @var CartRepositoryInterface
     */
    public $cartRepository;

    /**
     * @var CacheHelper
     */
    public $cacheHelper;

    /**
     * @var DateTime
     */
    public $date;

    /**
     * Data constructor.
     * @param Context $context
     * @param StoreManagerInterface $store_manager
     * @param ReplStoreRepositoryInterface $storeRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param SessionManagerInterface $session
     * @param Proxy $checkoutSession
     * @param ManagerInterface $messageManager
     * @param \Magento\Framework\Pricing\Helper\Data $priceHelper
     * @param LoyaltyHelper $loyaltyHelper
     * @param CartRepositoryInterface $cartRepository
     * @param CacheHelper $cacheHelper
     * @param LSR $lsr
     * @param DateTime $date
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $store_manager,
        ReplStoreRepositoryInterface $storeRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SessionManagerInterface $session,
        Proxy $checkoutSession,
        ManagerInterface $messageManager,
        \Magento\Framework\Pricing\Helper\Data $priceHelper,
        LoyaltyHelper $loyaltyHelper,
        CartRepositoryInterface $cartRepository,
        CacheHelper $cacheHelper,
        LSR $lsr,
        DateTime $date
    ) {
        $this->storeManager          = $store_manager;
        $this->storeRepository       = $storeRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->session               = $session;
        $this->checkoutSession       = $checkoutSession;
        $this->messageManager        = $messageManager;
        $this->priceHelper           = $priceHelper;
        $this->cartRepository        = $cartRepository;
        $this->loyaltyHelper         = $loyaltyHelper;
        $this->cacheHelper           = $cacheHelper;
        $this->lsr                   = $lsr;
        $this->date                  = $date;
        parent::__construct($context);
    }

    /**
     * @param $storeId
     * @return mixed
     */
    public function getStoreNameById($storeId)
    {
        $searchCriteria = $this->searchCriteriaBuilder->addFilter('nav_id', $storeId, 'eq')->create();
        $stores         = $this->storeRepository->getList($searchCriteria)->getItems();
        foreach ($stores as $store) {
            return $store->getData('Name');
        }
        return "Sorry! No store found with ID : " . $storeId;
    }

    /**
     * @param $storeId
     * @return array
     */
    public function getStoreHours($storeId)
    {
        $storeHours = null;
        try {
            $cacheId        = LSR::STORE . $storeId;
            $cachedResponse = $this->cacheHelper->getCachedContent($cacheId);
            if ($cachedResponse) {
                $storeResults = $cachedResponse;
            } else {
                // @codingStandardsIgnoreLine
                $request = new StoreGetById();
                $request->getOperationInput()->setStoreId($storeId);
                $response     = $request->execute();
                $storeResults = [];
                if (!empty($response)) {
                    $storeResults = $response->getResult()->getStoreHours()->getStoreHours();
                    $this->cacheHelper->persistContentInCache(
                        $cacheId,
                        $storeResults,
                        [Type::CACHE_TAG],
                        86400
                    );
                }
            }
            $counter    = 0;
            $storeHours = [];
            $today      = $this->date->gmtDate("Y-m-d");
            for ($i = 0; $i < 7; $i++) {
                $current          = date("Y-m-d", strtotime($today) + ($i * 86400));
                $currentDayOfWeek = date('w', strtotime($current));
                foreach ($storeResults as $key => $r) {
                    if ($r->getDayOfWeek() == $currentDayOfWeek) {
                        if ($this->checkDateValidity($current, $r)) {
                            if ($r->getType() == "Normal") {
                                $storeHours[$currentDayOfWeek]['normal']   =
                                    ["open" => $r->getOpenFrom(), "close" => $r->getOpenTo()];
                            } else {
                                $storeHours[$currentDayOfWeek]['temporary']   =
                                    ["open" => $r->getOpenFrom(), "close" => $r->getOpenTo()];
                            }
                            $storeHours[$currentDayOfWeek]['day']         = $r->getNameOfDay();
                            $counter++;
                        }
                        unset($storeResults[$key]);
                    }
                }

            }
            return $storeHours;
        } catch (Exception $e) {
            $this->_logger->error($e->getMessage());
        }

        return $storeHours;
    }

    /**
     * @param $current
     * @param $storeHoursObj StoreHours
     * @return bool
     */
    public function checkDateValidity($current, $storeHoursObj)
    {
        if ($storeHoursObj->getStartDate() && $storeHoursObj->getEndDate()) {
            if (strtotime($current) >= strtotime($storeHoursObj->getStartDate())
                && strtotime($current) <= strtotime($storeHoursObj->getEndDate())
            ) {
                return true;
            }
        } else {
            if ($storeHoursObj->getStartDate() && !$storeHoursObj->getEndDate()) {
                if (strtotime($current) >= strtotime($storeHoursObj->getStartDate())) {
                    return true;
                }
            } else {
                if (!$storeHoursObj->getStartDate() && $storeHoursObj->getEndDate()) {
                    if (strtotime($current) <= strtotime($storeHoursObj->getEndDate())) {
                        return true;
                    }
                }
            }
        }
        return false;
    }
    /**
     * @param $value
     */
    public function setValue($value)
    {
        $this->session->start();
        $this->session->setMessage($value);
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        $this->session->start();
        return $this->session->getMessage();
    }

    /**
     * @return mixed
     */
    public function unSetValue()
    {
        $this->session->start();
        return $this->session->unsMessage();
    }

    /**
     * @param $giftCardAmount
     * @param $loyaltyPoints
     * @param $basketData
     * @return float|int
     */
    public function getOrderBalance($giftCardAmount, $loyaltyPoints, $basketData)
    {
        $loyaltyAmount = 0;
        try {
            $loyaltyAmount = $this->loyaltyHelper->getPointRate() * $loyaltyPoints;
            if (!empty($basketData)) {
                $totalAmount = $basketData->getTotalAmount();
                return $totalAmount - $giftCardAmount - $loyaltyAmount;
            }
        } catch (Exception $e) {
            $this->_logger->error($e->getMessage());
        }
        return $loyaltyAmount;
    }

    /**
     * @param $giftCardNo
     * @param $giftCardAmount
     * @param $loyaltyPoints
     * @param $basketData
     * @return bool
     */
    public function orderBalanceCheck($giftCardNo, $giftCardAmount, $loyaltyPoints, $basketData)
    {
        try {
            $loyaltyAmount = $this->loyaltyHelper->getPointRate() * $loyaltyPoints;
            $cartId        = $this->checkoutSession->getQuoteId();
            $quote         = $this->cartRepository->get($cartId);
            if (!empty($basketData) && is_object($basketData)) {
                $totalAmount                   = $basketData->getTotalAmount();
                $discountAmount                = $basketData->getTotalDiscount();
                $combinedTotalLoyalGiftCard    = $giftCardAmount + $loyaltyAmount;
                $combinedDiscountPaymentamount = $discountAmount + $combinedTotalLoyalGiftCard;
                if ($loyaltyAmount > $totalAmount) {
                    $quote->setLsPointsSpent(0);
                    $this->cartRepository->save($quote);
                    $this->messageManager->addErrorMessage(
                        __(
                            'The loyalty points "%1" are not valid.',
                            $loyaltyPoints
                        )
                    );
                } elseif ($giftCardAmount > $totalAmount) {
                    $quote->setLsGiftCardAmountUsed(0);
                    $quote->setLsGiftCardNo(null);
                    $quote->collectTotals();
                    $this->cartRepository->save($quote);
                    $this->messageManager->addErrorMessage(
                        __(
                            'The gift card amount "%1" is not valid.',
                            $this->priceHelper->currency($giftCardAmount, true, false)
                        )
                    );
                } elseif ($combinedTotalLoyalGiftCard > $totalAmount) {
                    $quote->setLsPointsSpent(0);
                    $quote->setLsGiftCardAmountUsed(0);
                    $quote->setLsGiftCardNo(null);
                    $quote->collectTotals();
                    $this->cartRepository->save($quote);
                    $this->messageManager->addErrorMessage(
                        __(
                            'The gift card amount "%1" and loyalty points "%2" are not valid.',
                            $this->priceHelper->currency(
                                $giftCardAmount,
                                true,
                                false
                            ),
                            $loyaltyPoints
                        )
                    );
                } elseif ($combinedDiscountPaymentamount > $totalAmount) {
                    return false;
                } else {
                    return true;
                }
            } else {
                return true;
            }
        } catch (Exception $e) {
            $this->_logger->error($e->getMessage());
        }
        return true;
    }
}
