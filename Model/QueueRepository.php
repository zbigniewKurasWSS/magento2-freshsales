<?php

namespace Wss\FreshSales\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Wss\FreshSales\Api\QueueRepositoryInterface;
use Wss\FreshSales\Api\Data\QueueInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Wss\FreshSales\Api\Data\QueueSearchResultInterfaceFactory as SearchResultFactory;
use Wss\FreshSales\Model\QueueFactory;
use Wss\FreshSales\Model\ResourceModel\Queue\CollectionFactory as QueueCollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Class QueueRepository
 */
class QueueRepository implements QueueRepositoryInterface
{
    /**
     * @var QueueFactory
     */
    protected $queueFactory;

    /**
     * @var QueueCollectionFactory
     */
    protected $queueCollectionFactory;

    /**
     * @var SearchResultFactory
     */
    protected $searchResultFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @param QueueCollectionFactory $queueCollectionFactory
     * @param SearchResultFactory $searchResultFactory
     * @param \Wss\FreshSales\Model\QueueFactory $queueFactory
     */
    public function __construct(
        QueueCollectionFactory $queueCollectionFactory,
        SearchResultFactory $searchResultFactory,
        QueueFactory $queueFactory,
        CollectionProcessorInterface $collectionProcessor = null
    ) {
        $this->queueFactory = $queueFactory;
        $this->queueCollectionFactory = $queueCollectionFactory;
        $this->searchResultFactory = $searchResultFactory;
        $this->collectionProcessor = $collectionProcessor ?: $this->getCollectionProcessor();
    }

    /**
     * @param int $id
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {
        $queue = $this->queueFactory->create();
        $queue->getResource()->load($queue, $id);
        if (! $queue->getId()) {
            throw new NoSuchEntityException(__('Unable to find queue with ID "%1"', $id));
        }
        return $queue;
    }

    /**
     * @param QueueInterface $queue
     * @return QueueInterface
     */
    public function save(QueueInterface $queue)
    {
        $queue->getResource()->save($queue);
        return $queue;
    }

    /**
     * @param QueueInterface $queue
     * @return bool|void
     */
    public function delete(QueueInterface $queue)
    {
        $queue->getResource()->delete($queue);
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Wss\FreshSales\Api\Data\QueueSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $searchResult = $this->searchResultFactory->create();
        $this->collectionProcessor->process($searchCriteria, $searchResult);
        $searchResult->setSearchCriteria($searchCriteria);
        return $searchResult;
    }

    /**
     * Retrieve collection processor
     *
     * @deprecated 101.0.0
     * @return CollectionProcessorInterface
     */
    private function getCollectionProcessor()
    {
        if (!$this->collectionProcessor) {
            $this->collectionProcessor = \Magento\Framework\App\ObjectManager::getInstance()->get(
                CollectionProcessorInterface::class
            );
        }
        return $this->collectionProcessor;
    }
}
