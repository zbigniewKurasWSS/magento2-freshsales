<?php

namespace Wss\FreshSales\Api;

/**
 * @api
 */
interface QueueRepositoryInterface
{
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Wss\FreshSales\Api\Data\QueueSearchResultInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * @param int $id
     * @return \Wss\FreshSales\Api\Data\QueueInterface
     */
    public function getById($id);

    /**
     * @param \Wss\FreshSales\Api\Data\QueueInterface $queue
     * @return bool
     */
    public function delete(\Wss\FreshSales\Api\Data\QueueInterface $queue);

    /**
     * @param \Wss\FreshSales\Api\Data\QueueInterface $queue
     * @return \Wss\FreshSales\Api\Data\QueueInterface
     */
    public function save(\Wss\FreshSales\Api\Data\QueueInterface $queue);
}
