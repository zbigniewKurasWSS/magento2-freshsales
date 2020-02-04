<?php

namespace Wss\FreshSales\Api\Data;

/**
 * @api
 */
interface QueueSearchResultInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Gets collection items.
     *
     * @return \Wss\FreshSales\Api\Data\QueueInterface[] Array of collection items.
     */
    public function getItems();

    /**
     * Sets collection items.
     *
     * @param \Wss\FreshSales\Api\Data\QueueInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
