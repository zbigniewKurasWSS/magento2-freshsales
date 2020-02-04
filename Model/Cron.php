<?php

namespace Wss\FreshSales\Model;

use Wss\FreshSales\Api\QueueRepositoryInterface;
use Wss\FreshSales\Api\Data\QueueInterface;
use Wss\FreshSales\Model\Config;
use Wss\FreshSales\Model\Queue;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Wss\FreshSales\Model\Api\Contacts as ContactsAoi;

class Cron
{
    /**
     * @var int
     */
    protected $limit = 50;

    /**
     * @var QueueRepositoryInterface
     */
    protected $queueRepository;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var ContactsAoi
     */
    protected $contactsApi;

    /**
     * @param QueueRepositoryInterface $queueRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param Config $config
     * @param ContactsAoi $contactsApi
     */
    public function __construct(
        QueueRepositoryInterface $queueRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        Config $config,
        ContactsAoi $contactsApi
    ) {
        $this->queueRepository = $queueRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->config = $config;
        $this->contactsApi = $contactsApi;
    }

    public function runQueue()
    {
        if ($this->config->isActive()) {
            $searchCriteria = $this->searchCriteriaBuilder
                ->addFilter(QueueInterface::STATUS, 0)
                ->setPageSize($this->limit)
                ->create();
            $list = $this->queueRepository->getList($searchCriteria);
            foreach ($list->getItems() as $item) {
                $this->contactsApi->insert($item->getCustomerId());
                $item->setStatus(Queue::STATUS_SENT);
                $item->setUpdatedAt(date('Y-m-d H:i:s'));
                $this->queueRepository->save($item);
            }
        }
    }
}
