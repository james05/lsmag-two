<?php

namespace Ls\Customer\Controller\Order;

use \Ls\Omni\Client\Ecommerce\Entity\Enum\DocumentIdType;
use \Ls\Omni\Client\Ecommerce\Entity\SalesEntryGetResponse;
use \Ls\Omni\Client\ResponseInterface;
use \Ls\Omni\Helper\OrderHelper;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class View
 * @package Ls\Customer\Controller\Order
 */
class View extends Action
{
    /**
     * @var ManagerInterface
     */
    public $messageManager;

    /**
     * @var ResultFactory
     */
    public $resultRedirect;

    /** @var PageFactory */
    public $resultPageFactory;

    /**
     * @var Http $request
     */
    public $request;

    /**
     * @var OrderHelper
     */
    public $orderHelper;

    /**
     * @var Registry
     */
    public $registry;

    /**
     * View constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Http $request
     * @param OrderHelper $orderHelper
     * @param Registry $registry
     * @param ResultFactory $result
     * @param ManagerInterface $messageManager
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Http $request,
        OrderHelper $orderHelper,
        Registry $registry,
        ResultFactory $result,
        ManagerInterface $messageManager
    ) {
        $this->resultRedirect    = $result;
        $this->messageManager    = $messageManager;
        $this->request           = $request;
        $this->registry          = $registry;
        $this->orderHelper       = $orderHelper;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|ResultInterface|Page
     */
    public function execute()
    {
        $response = null;
        if ($this->request->getParam('order_id')) {
            $docId = $this->request->getParam('order_id');
            $type  = $this->request->getParam('type');
            if (empty($type)) {
                $type = DocumentIdType::ORDER;
            }
            $response = $this->setCurrentOrderInRegistry($docId, $type);
            if ($response === null || !$this->orderHelper->isAuthorizedForOrder($response)) {
                return $this->_redirect('sales/order/history/');
            }
            if ($type === DocumentIdType::ORDER) {
                $this->setCurrentMagOrderInRegistry($docId);
            }
            $this->registry->register('current_invoice_option', false);
        }
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }

    /**
     * @param $docId
     * @param $type
     * @return SalesEntryGetResponse|ResponseInterface|null
     */
    public function setCurrentOrderInRegistry($docId, $type)
    {
        $response = $this->orderHelper->getOrderDetailsAgainstId($docId, $type);
        if ($response) {
            $this->setOrderInRegistry($response);
        }
        return $response;
    }

    /**
     * @param $order
     */
    public function setOrderInRegistry($order)
    {
        $this->registry->register('current_order', $order);
    }

    /**
     * @param $orderId
     */
    public function setCurrentMagOrderInRegistry($orderId)
    {
        $order = $this->orderHelper->getOrderByDocumentId($orderId);
        $this->registry->register('current_mag_order', $order);
    }
}
