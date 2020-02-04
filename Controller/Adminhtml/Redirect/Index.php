<?php

namespace Wss\FreshSales\Controller\Adminhtml\Redirect;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Wss\FreshSales\Model\Config;
use Magento\Backend\App\Action\Context;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var CustomerRepositoryInterface
     */
    protected $customerRepository;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @param Context $context
     * @param CustomerRepositoryInterface $customerRepository
     * @param Config $config
     */
    public function __construct(
        Context $context,
        CustomerRepositoryInterface $customerRepository,
        Config $config
    ) {
        parent::__construct($context);
        $this->customerRepository = $customerRepository;
        $this->config = $config;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        $customerId = $this->getRequest()->getParam('customer_id');
        if (!$customerId) {
            $this->messageManager->addErrorMessage(__('Empty customer id'));
            $this->_redirect($this->getUrl('customer/index/'));
            return;
        }
        try {
            $customer = $this->customerRepository->getById($customerId);
        } catch (NoSuchEntityException $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
            $this->_redirect($this->getUrl('customer/index/'));
            return;
        }

        $freshsales = $customer->getCustomAttribute('freshsales_id');
        if ($freshsales === null) {
            $this->messageManager->addErrorMessage(__('Empty freshsales id'));
            $this->_redirect($this->getUrl('customer/index/edit',['id' => $customerId]));
            return;
        }
        $freshsalesId = $freshsales->getValue();
        $domian = $this->config->getApiDomain();
        if ($domian) {
            $this->_redirect(str_replace('/api', '', $domian) . '/contacts/' . $freshsalesId);
            return;
        }
        $this->messageManager->addErrorMessage(__('Module not configured.'));
        $this->_redirect($this->getUrl('customer/index/edit',['id' => $customerId]));
        return;
    }
}
