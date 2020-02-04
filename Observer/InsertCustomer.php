<?php

namespace Wss\FreshSales\Observer;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Wss\FreshSales\Api\QueueRepositoryInterface;
use Wss\FreshSales\Model\Config;
use Wss\FreshSales\Model\QueueFactory;
use Psr\Log\LoggerInterface;

class InsertCustomer implements ObserverInterface
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @var CustomerRepositoryInterface
     */
    protected $customerRepositoryInterface;

    /**
     * @var QueueRepositoryInterface
     */
    protected $queueRepository;

    /**
     * @var QueueFactory
     */
    protected $queueFactory;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param Config $config
     * @param CustomerRepositoryInterface $customerRepositoryInterface
     * @param QueueRepositoryInterface $queueRepository
     */
    public function __construct(
        Config $config,
        CustomerRepositoryInterface $customerRepositoryInterface,
        QueueRepositoryInterface $queueRepository,
        QueueFactory $queueFactory,
        LoggerInterface $logger
    ) {
        $this->config = $config;
        $this->customerRepositoryInterface = $customerRepositoryInterface;
        $this->queueRepository = $queueRepository;
        $this->queueFactory = $queueFactory;
        $this->logger = $logger;
    }

    /**
     * @param Observer $observer
     * @throws \Exception
     */
    public function execute(Observer $observer) : void
    {
        if ($this->config->isActive()) {
            $customer = $observer->getEvent()->getCustomer();
            $queue = $this->queueFactory->create();
            $queue->setAction('insert')
                ->setCustomerId($customer->getId());
            $this->queueRepository->save($queue);
        }
    }
}
