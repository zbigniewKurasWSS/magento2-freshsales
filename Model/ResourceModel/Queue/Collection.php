<?php

namespace Wss\FreshSales\Model\ResourceModel\Queue;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Wss\FreshSales\Api\Data\QueueInterface;
use Wss\FreshSales\Api\Data\QueueSearchResultInterface;

class Collection extends AbstractCollection implements QueueSearchResultInterface
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    /**
     * @var SearchCriteriaInterface
     */
    protected $searchCriteria;

    public function _construct()
    {
        $this->_init(
            \Wss\FreshSales\Model\Queue::class,
            \Wss\FreshSales\Model\ResourceModel\Queue::class
        );
    }

    /**
     * @param array|null $items
     * @return $this|QueueSearchResultInterface
     * @throws \Exception
     */
    public function setItems(array $items = null)
    {
        if (!$items) {
            return $this;
        }
        foreach ($items as $item) {
            $this->addItem($item);
        }
        return $this;
    }

    /**
     * @return \Magento\Framework\Api\SearchCriteriaInterface|SearchCriteriaInterface
     */
    public function getSearchCriteria()
    {
        return $this->searchCriteria;
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface|null $searchCriteria
     * @return $this|QueueSearchResultInterface
     */
    public function setSearchCriteria(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria = null)
    {
        $this->searchCriteria = $searchCriteria;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalCount()
    {
        return $this->getSize();
    }

    /**
     * @param int $totalCount
     * @return $this|QueueSearchResultInterface
     */
    public function setTotalCount($totalCount)
    {
        return $this;
    }
}
